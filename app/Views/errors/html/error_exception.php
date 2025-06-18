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
    :root {
        --color1: #4d807e;  /* Principal para botones/acentos */
        --color2: #3a6564;  /* Secundario */
        --color3: #2a4e4c;  /* Títulos/texto importante */
        --color4: #1a3736;  /* Texto principal */
        --color5: #0d2524;  /* Texto fuerte */
        --bg-light: #ffffff; /* Fondo blanco */
        --border-color: #e0e0e0; /* Bordes grises */
        --code-bg: #f5f5f5; /* Fondo código */
    }
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background-color: var(--bg-light);
        color: var(--color5);
        line-height: 1.6;
        padding: 20px;
    }
    
    .header, .container {
        background-color: white;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        margin-bottom: 20px;
        padding: 20px;
        border: 1px solid var(--border-color);
    }
    
    .environment {
        font-family: monospace;
        font-size: 0.85em;
        color: var(--color2);
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border-color);
    }
    
    h1 {
        color: var(--color5);
        font-size: 1.5em;
        margin-bottom: 10px;
    }
    
    h3 {
        color: var(--color4);
        margin: 15px 0 10px 0;
        font-weight: 600;
    }
    
    p, pre {
        margin: 10px 0;
        color: var(--color4);
    }
    
    a {
        color: var(--color1);
        text-decoration: none;
        font-weight: 500;
    }
    
    a:hover {
        color: var(--color3);
        text-decoration: underline;
    }
    
    .source {
        background-color: var(--code-bg);
        padding: 15px;
        margin: 15px 0;
        border-left: 3px solid var(--color1);
        overflow-x: auto;
    }
    
    .source pre {
        font-family: 'Courier New', monospace;
        font-size: 0.9em;
        color: var(--color5);
    }
    
    .line.highlight {
        background-color: rgba(77, 128, 126, 0.15);
    }
    
    .line-number {
        color: var(--color2);
        display: inline-block;
        width: 30px;
        user-select: none;
    }
    
    .tabs {
        display: flex;
        list-style: none;
        margin: 0 0 15px 0;
        border-bottom: 1px solid var(--border-color);
    }
    
    .tabs li {
        margin-right: 5px;
    }
    
    .tabs a {
        display: block;
        padding: 8px 15px;
        color: var(--color2);
        border-bottom: 2px solid transparent;
        font-weight: 600;
    }
    
    .tabs a:hover, .tabs a.active {
        color: var(--color5);
        border-bottom-color: var(--color1);
    }
    
    .content {
        display: none;
    }
    
    .content.active {
        display: block;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
        font-size: 0.9em;
    }
    
    th, td {
        padding: 8px 10px;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }
    
    th {
        background-color: var(--color1);
        color: white;
    }
    
    .trace li {
        padding: 12px;
        margin-bottom: 8px;
        background-color: var(--code-bg);
        border-left: 3px solid var(--color1);
    }
    
    .alert {
        background-color: rgba(77, 128, 126, 0.08);
        padding: 12px;
        border-left: 3px solid var(--color1);
        margin: 15px 0;
        color: var(--color5);
    }
    
    .args {
        display: none;
        margin-top: 10px;
    }
    
    code {
        background-color: rgba(77, 128, 126, 0.1);
        padding: 2px 4px;
        border-radius: 3px;
        color: var(--color5);
        font-family: monospace;
        font-size: 0.9em;
    }
    
    @media (max-width: 768px) {
        body {
            padding: 10px;
        }
        
        .header, .container {
            padding: 15px;
        }
        
        .tabs {
            overflow-x: auto;
            padding-bottom: 5px;
        }
    }
</style>

    <script>
        function init() {
            // Activate first tab by default
            document.querySelector('.tabs a').classList.add('active');
            
            // Tab functionality
            const tabs = document.querySelectorAll('.tabs a');
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Hide all content
                    document.querySelectorAll('.content').forEach(content => {
                        content.classList.remove('active');
                    });
                    
                    // Deactivate all tabs
                    tabs.forEach(t => {
                        t.classList.remove('active');
                    });
                    
                    // Activate current tab
                    this.classList.add('active');
                    
                    // Show corresponding content
                    const contentId = this.getAttribute('href').substring(1);
                    document.getElementById(contentId).classList.add('active');
                });
            });
        }
        
        function toggle(id) {
            const element = document.getElementById(id);
            element.style.display = element.style.display === 'none' ? 'block' : 'none';
            return false;
        }
    </script>
</head>
<body onload="init()">

    <!-- Header -->
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

    <!-- Source -->
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

    <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE) : ?>
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

            <!-- Backtrace -->
            <div class="content" id="backtrace">

                <ol class="trace">
                <?php foreach ($trace as $index => $row) : ?>

                    <li>
                        <p>
                            <!-- Trace info -->
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

                            <!-- Class/Method -->
                            <?php if (isset($row['class'])) : ?>
                                &nbsp;&nbsp;&mdash;&nbsp;&nbsp;<?= esc($row['class'] . $row['type'] . $row['function']) ?>
                                <?php if (! empty($row['args'])) : ?>
                                    <?php $argsId = $errorId . 'args' . $index ?>
                                    ( <a href="#" onclick="return toggle('<?= esc($argsId, 'attr') ?>');">arguments</a> )
                                    <div class="args" id="<?= esc($argsId, 'attr') ?>">
                                        <table cellspacing="0">

                                        <?php
                                        $params = null;
                                        // Reflection by name is not available for closure function
                                        if (! str_ends_with($row['function'], '}')) {
                                            $mirror = isset($row['class']) ? new ReflectionMethod($row['class'], $row['function']) : new ReflectionFunction($row['function']);
                                            $params = $mirror->getParameters();
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
                                &nbsp;&nbsp;&mdash;&nbsp;&nbsp;    <?= esc($row['function']) ?>()
                            <?php endif; ?>
                        </p>

                        <!-- Source? -->
                        <?php if (isset($row['file']) && is_file($row['file']) && isset($row['class'])) : ?>
                            <div class="source">
                                <?= static::highlightFile($row['file'], $row['line']) ?>
                            </div>
                        <?php endif; ?>
                    </li>

                <?php endforeach; ?>
                </ol>

            </div>

            <!-- Server -->
            <div class="content" id="server">
                <?php foreach (['_SERVER', '_SESSION'] as $var) : ?>
                    <?php
                    if (empty($GLOBALS[$var]) || ! is_array($GLOBALS[$var])) {
                        continue;
                    } ?>

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

                <?php endforeach ?>

                <!-- Constants -->
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

            <!-- Request -->
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
                            <td><?= esc($request->getMethod()) ?></td>
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
                    <?php
                    if (empty($GLOBALS[$var]) || ! is_array($GLOBALS[$var])) {
                        continue;
                    } ?>

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
                        <?php foreach ($headers as $name => $value) : ?>
                            <tr>
                                <td><?= esc($name, 'html') ?></td>
                                <td>
                                <?php
                                if ($value instanceof Header) {
                                    echo esc($value->getValueLine(), 'html');
                                } else {
                                    foreach ($value as $i => $header) {
                                        echo ' ('. $i+1 . ') ' . esc($header->getValueLine(), 'html');
                                    }
                                }
                                ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
            </div>

            <!-- Response -->
            <?php
                $response = Services::response();
                $response->setStatusCode(http_response_code());
            ?>
            <div class="content" id="response">
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
                                <td>
                                <?php
                                if ($value instanceof Header) {
                                    echo esc($response->getHeaderLine($name), 'html');
                                } else {
                                    foreach ($value as $i => $header) {
                                        echo ' ('. $i+1 . ') ' . esc($header->getValueLine(), 'html');
                                    }
                                }
                                ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
            </div>

            <!-- Files -->
            <div class="content" id="files">
                <?php $files = get_included_files(); ?>

                <ol>
                <?php foreach ($files as $file) :?>
                    <li><?= esc(clean_path($file)) ?></li>
                <?php endforeach ?>
                </ol>
            </div>

            <!-- Memory -->
            <div class="content" id="memory">

                <table>
                    <tbody>
                        <tr>
                            <td>Memory Usage</td>
                            <td><?= esc(static::describeMemory(memory_get_usage(true))) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 12em">Peak Memory Usage:</td>
                            <td><?= esc(static::describeMemory(memory_get_peak_usage(true))) ?></td>
                        </tr>
                        <tr>
                            <td>Memory Limit:</td>
                            <td><?= esc(ini_get('memory_limit')) ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>  <!-- /tab-content -->

    </div> <!-- /container -->
    <?php endif; ?>

</body>
</html>