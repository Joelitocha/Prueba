<?php
use CodeIgniter\HTTP\Header;
use Config\Services;
use CodeIgniter\CodeIgniter;

$errorId = uniqid('error', true);
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">

    <title><?= esc($title) ?></title>
    <style>
        /* Estilos personalizados con tu paleta de colores. */
        :root {
            --color1: #4d807e; /* Verde azulado claro (títulos, acentos) */
            --color2: #3a6564; /* Verde azulado medio (enlaces) */
            --color3: #274b49; /* Verde azulado oscuro (bordes, fondos secundarios) */
            --color4: #13302f; /* Verde muy oscuro (fondos principales) */
            --color5: #001614; /* Casi negro (fondo general) */
            --font-color: #DDE6E6; /* Color de fuente claro para contraste */
            --alert-color: #ffc107; /* Amarillo para alertas */
        }

        body {
            background-color: var(--color5);
            color: var(--font-color);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            font-size: 16px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }
        .header {
            background-color: var(--color4);
            padding: 1.5rem;
            border-bottom: 1px solid var(--color3);
        }
        .header h1 {
            color: var(--color1);
            margin: 0;
            font-size: 2.5rem;
        }
        .header p {
            font-size: 1.1rem;
            margin: 0.5rem 0 0;
        }
        .environment {
            color: #999;
            font-size: 0.9rem;
            padding-bottom: 1rem;
        }
        a {
            color: var(--color2);
            text-decoration: none;
        }
        a:hover {
            color: var(--color1);
            text-decoration: underline;
        }
        .source {
            background-color: var(--color4);
            border: 1px solid var(--color3);
            padding: 1rem;
            margin-top: 1rem;
            overflow-x: auto;
        }
        .source pre { margin: 0; }
        .trace li {
            padding: 0.75rem;
            border-bottom: 1px solid var(--color3);
        }
        .trace li:last-child { border-bottom: none; }
        .tabs {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            border-bottom: 1px solid var(--color3);
        }
        .tabs li a {
            display: block;
            padding: 0.8rem 1.2rem;
            color: var(--font-color);
            border-top: 4px solid transparent;
            transition: all 0.2s ease-in-out;
        }
        .tabs li a.active, .tabs li a:hover {
            background-color: var(--color3);
            color: #fff;
            border-top-color: var(--color1);
            text-decoration: none;
        }
        .tab-content .content {
            padding: 1.5rem;
            display: none;
        }
        .tab-content .content.active { display: block; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        table th, table td {
            padding: 0.8rem;
            border: 1px solid var(--color3);
            text-align: left;
            vertical-align: top;
        }
        table th {
            background-color: var(--color3);
            font-weight: bold;
        }
        table td code {
            font-family: "Courier New", Courier, monospace;
            color: var(--color1);
        }
        table pre {
            margin: 0;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .args {
            display: none;
            margin-top: 1rem;
            border-left: 3px solid var(--color2);
            padding-left: 1rem;
        }
        .args table td { background-color: var(--color4); }
        .alert {
            padding: 1rem;
            background-color: var(--color3);
            border: 1px solid var(--color2);
            color: var(--font-color);
            margin-top: 1rem;
        }
        .alert-warning {
            background-color: rgba(255, 193, 7, 0.1);
            border-left: 5px solid var(--alert-color);
            color: var(--alert-color);
            padding: 1rem;
        }
        /* La clase 'highlight' se usa para resaltar la línea del error */
        .highlight {
            background-color: rgba(77, 128, 126, 0.2); /* Color 1 con transparencia */
        }
        ol.trace, ol#files {
             padding-left: 1.5rem;
        }
        ol#files li {
            padding: 0.2rem 0;
        }
    </style>

    <script>
        <?= file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'debug.js') ?>
    </script>
</head>
<body onload="init()">

    <div class="header">
        <div class="environment">
            Displayed at <?= esc(date('H:i:sa')) ?> &mdash;
            PHP: <?= esc(PHP_VERSION) ?>  &mdash;
            CodeIgniter: <?= esc(CodeIgniter::CI_VERSION) ?> --
            Environment: <?= ENVIRONMENT ?>
        </div>
        <div class="container">
            <h1><?= esc($title), esc($exception->getCode() ? ' #' . $exception->getCode() : '') ?></h1>
            <p>
                <?= nl2br(esc($exception->getMessage())) ?>
                <a href="https://www.duckduckgo.com/?q=<?= urlencode($title . ' ' . preg_replace('#\'.*\'|".*"#Us', '', $exception->getMessage())) ?>"
                   rel="noreferrer" target="_blank">search &rarr;</a>
            </p>
        </div>
    </div>

    <div class="container">
        <p><b><?= esc(clean_path($file)) ?></b> at line <b><?= esc($line) ?></b></p>

        <?php if (is_file($file)) : ?>
            <div class="source">
                <?= static::highlightFile($file, $line, 15); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="container">
        <?php
        $last = $exception;

        while ($prevException = $last->getPrevious()) {
            $last = $prevException;
            ?>

    <pre>
    Caused by:
    <?= esc($prevException::class), esc($prevException->getCode() ? ' #' . $prevException->getCode() : '') ?>

    <?= nl2br(esc($prevException->getMessage())) ?>
    <a href="https://www.duckduckgo.com/?q=<?= urlencode($prevException::class . ' ' . preg_replace('#\'.*\'|".*"#Us', '', $prevException->getMessage())) ?>"
       rel="noreferrer" target="_blank">search &rarr;</a>
    <?= esc(clean_path($prevException->getFile()) . ':' . $prevException->getLine()) ?>
    </pre>

        <?php
        }
        ?>
    </div>

    <div class="container">

        <ul class="tabs" id="tabs">
            <li><a href="#backtrace">Backtrace</a></li>
            <li><a href="#server">Server</a></li>
            <li><a href="#request">Request</a></li>
            <li><a href="#response">Response</a></li>
            <li><a href="#files">Files</a></li>
            <li><a href="#memory">Memory</a></li>
        </ul>

        <div class="tab-content">

            <div class="content" id="backtrace">

                <?php if (isset($trace) && ! empty($trace)) : ?>
                    <ol class="trace">
                    <?php foreach ($trace as $index => $row) : ?>

                        <li>
                            <p>
                                <?php if (isset($row['file']) && is_file($row['file'])) : ?>
                                    <?php
                                    if (isset($row['function']) && in_array($row['function'], ['include', 'include_once', 'require', 'require_once'], true)) {
                                        echo esc($row['function'] . ' ' . clean_path($row['file']));
                                    } else {
                                        echo esc(clean_path($row['file']) . ' : ' . $row['line']);
                                    }
                                    ?>
                                <?php else: ?>
                                    {PHP internal code}
                                <?php endif; ?>

                                <?php if (isset($row['class'])) : ?>
                                    &nbsp;&nbsp;&mdash;&nbsp;&nbsp;<?= esc($row['class'] . $row['type'] . $row['function']) ?>
                                    <?php if (! empty($row['args'])) : ?>
                                        <?php $argsId = $errorId . 'args' . $index ?>
                                        ( <a href="#" onclick="return toggle('<?= esc($argsId, 'attr') ?>');">arguments</a> )
                                        <div class="args" id="<?= esc($argsId, 'attr') ?>">
                                            <table cellspacing="0">

                                            <?php
                                            $params = null;
                                            if (! str_ends_with($row['function'], '}')) {
                                                try {
                                                    $mirror = isset($row['class']) ? new ReflectionMethod($row['class'], $row['function']) : new ReflectionFunction($row['function']);
                                                    $params = $mirror->getParameters();
                                                } catch (ReflectionException $e) {
                                                    // Function does not exist...
                                                }
                                            }

                                            foreach ($row['args'] as $key => $value) : ?>
                                                <tr>
                                                    <td><code><?= esc(isset($params[$key]) ? '$' . $params[$key]->name : "#{$key}") ?></code></td>
                                                    <td><pre><?= esc(print_r($value, true)) ?></pre></td>
                                                </tr>
                                            <?php endforeach ?>

                                            </table>
                                        </div>
                                    <?php else : ?>
                                        ()
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (! isset($row['class']) && isset($row['function'])) : ?>
                                    &nbsp;&nbsp;&mdash;&nbsp;&nbsp;   <?= esc($row['function']) ?>()
                                <?php endif; ?>
                            </p>

                            <?php if (isset($row['file']) && is_file($row['file']) && isset($row['line'])) : ?>
                                <div class="source">
                                    <?= static::highlightFile($row['file'], $row['line']) ?>
                                </div>
                            <?php endif; ?>
                        </li>

                    <?php endforeach; ?>
                    </ol>
                <?php else : ?>
                    <div class="alert-warning">
                        <strong>Backtrace no disponible.</strong>
                        <p>
                            Para habilitar el backtrace, asegúrate de que la constante `SHOW_DEBUG_BACKTRACE` esté definida como `true` en tu entorno.
                            Generalmente, esto se configura en el archivo `.env` estableciendo `CI_ENVIRONMENT = development`.
                        </p>
                    </div>
                <?php endif; ?>

            </div>

            <div class="content" id="server">
                <?php foreach (['_SERVER', '_SESSION'] as $var) : ?>
                    <?php if (isset($GLOBALS[$var]) && ! empty($GLOBALS[$var]) && is_array($GLOBALS[$var])) : ?>
                        <h3>$<?= esc($var) ?></h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($GLOBALS[$var] as $key => $value) : ?>
                                <tr>
                                    <td><?= esc($key) ?></td>
                                    <td>
                                        <?php if (is_string($value)) : ?>
                                            <?= esc($value) ?>
                                        <?php else: ?>
                                            <pre><?= esc(print_r($value, true)) ?></pre>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php endforeach ?>

                <?php $constants = get_defined_constants(true); ?>
                <?php if (! empty($constants['user'])) : ?>
                    <h3>Constants</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($constants['user'] as $key => $value) : ?>
                            <tr>
                                <td><?= esc($key) ?></td>
                                <td>
                                    <?php if (is_string($value)) : ?>
                                        <?= esc($value) ?>
                                    <?php else: ?>
                                        <pre><?= esc(print_r($value, true)) ?></pre>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <div class="content" id="request">
                <?php $request = Services::request(); ?>

                <table>
                    <tbody>
                        <tr>
                            <td style="width: 10em">Path</td>
                            <td><?= esc($request->getUri()) ?></td>
                        </tr>
                        <tr>
                            <td>HTTP Method</td>
                            <td><?= esc(strtoupper($request->getMethod())) ?></td>
                        </tr>
                        <tr>
                            <td>IP Address</td>
                            <td><?= esc($request->getIPAddress()) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 10em">Is AJAX Request?</td>
                            <td><?= $request->isAJAX() ? 'yes' : 'no' ?></td>
                        </tr>
                        <tr>
                            <td>Is CLI Request?</td>
                            <td><?= $request->isCLI() ? 'yes' : 'no' ?></td>
                        </tr>
                        <tr>
                            <td>Is Secure Request?</td>
                            <td><?= $request->isSecure() ? 'yes' : 'no' ?></td>
                        </tr>
                        <tr>
                            <td>User Agent</td>
                            <td><?= esc($request->getUserAgent()->getAgentString()) ?></td>
                        </tr>
                    </tbody>
                </table>

                <?php $empty = true; ?>
                <?php foreach (['_GET', '_POST', '_COOKIE'] as $var) : ?>
                    <?php if (isset($GLOBALS[$var]) && ! empty($GLOBALS[$var]) && is_array($GLOBALS[$var])) : ?>
                        <?php $empty = false; ?>
                        <h3>$<?= esc($var) ?></h3>
                        <table style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($GLOBALS[$var] as $key => $value) : ?>
                                <tr>
                                    <td><?= esc($key) ?></td>
                                    <td>
                                        <?php if (is_string($value)) : ?>
                                            <?= esc($value) ?>
                                        <?php else: ?>
                                            <pre><?= esc(print_r($value, true)) ?></pre>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php endforeach ?>

                <?php if ($empty) : ?>
                    <div class="alert">
                        No $_GET, $_POST, or $_COOKIE Information to show.
                    </div>
                <?php endif; ?>

                <?php $headers = $request->headers(); ?>
                <?php if (! empty($headers)) : ?>
                    <h3>Headers</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Header</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($headers as $header) : ?>
                            <tr>
                                <td><?= esc($header->getName(), 'html') ?></td>
                                <td><?= esc($header->getValueLine(), 'html') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <div class="content" id="response">
                <?php $response = Services::response(); $response->setStatusCode(http_response_code()); ?>
                <table>
                    <tr>
                        <td style="width: 15em">Response Status</td>
                        <td><?= esc($response->getStatusCode() . ' - ' . $response->getReasonPhrase()) ?></td>
                    </tr>
                </table>

                <?php $headers = $response->headers(); ?>
                <?php if (! empty($headers)) : ?>
                    <h3>Headers</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Header</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($headers as $name => $value) : ?>
                            <tr>
                                <td><?= esc($name, 'html') ?></td>
                                <td><?= esc($response->getHeaderLine($name), 'html') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

php
            <div class="content" id="files">
                <?php $files = get_included_files(); ?>
                <ol id="files">
                <?php foreach ($files as $file) :?>
                    <li><?= esc(clean_path($file)) ?></li>
                <?php endforeach ?>
                </ol>
            </div>

            <div class="content" id="memory">
                <table>
                    <tbody>
                        <tr>
                            <td style="width: 12em">Memory Usage</td>
                            <td><?= esc(static::describeMemory(memory_get_usage(true))) ?></td>
                        </tr>
                        <tr>
                            <td>Peak Memory Usage:</td>
                            <td><?= esc(static::describeMemory(memory_get_peak_usage(true))) ?></td>
                        </tr>
                        <tr>
                            <td>Memory Limit:</td>
                            <td><?= esc(ini_get('memory_limit')) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>  </div> </body>
</html>