<?php
use CodeIgniter\HTTP\Header;
use Config\Services;
use CodeIgniter\CodeIgniter;

$errorId = uniqid('error', true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> | RackON.tech</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --color-dark: #242d43;
            --color-primary: #3a4259;
            --color-secondary: #4f5870;
            --color-medium: #656d86;
            --color-light: #7a829c;
            --color-accent: #00c6ff;
            --text-color: #f0f2f5;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            min-height: 100vh;
            background: 
                linear-gradient(rgba(36, 45, 67, 0.9), rgba(36, 45, 67, 0.95)),
                url('https://images.unsplash.com/photo-1620712943543-bcc4688e7485?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat fixed;
            font-family: 'Roboto', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            padding: 2rem;
        }
        
        .main-container {
            width: 75vw;
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(36, 45, 67, 0.8);
            border-radius: 10px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(122, 130, 156, 0.3);
            backdrop-filter: blur(8px);
            overflow: hidden;
        }
        
        .header {
            padding: 2rem;
            border-bottom: 1px solid var(--color-primary);
        }
        
        .environment {
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.8rem;
            color: var(--color-light);
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--color-primary);
        }
        
        h1 {
            font-family: 'Share Tech Mono', monospace;
            color: var(--color-accent);
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 10px rgba(0, 198, 255, 0.5);
        }
        
        .container {
            padding: 2rem;
            border-bottom: 1px solid var(--color-primary);
        }
        
        p, pre {
            margin: 1rem 0;
            color: var(--color-light);
            font-size: 1rem;
        }
        
        a {
            color: var(--color-accent);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        a:hover {
            color: white;
            text-shadow: 0 0 5px rgba(0, 198, 255, 0.7);
        }
        
        .source {
            background: rgba(58, 66, 89, 0.6);
            border-radius: 5px;
            padding: 1rem;
            margin: 1rem 0;
            overflow-x: auto;
        }
        
        .source pre {
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 0;
        }
        
        .source .line {
            display: block;
            min-height: 1.2rem;
        }
        
        .source .line.highlight {
            background: rgba(0, 198, 255, 0.15);
            border-left: 3px solid var(--color-accent);
        }
        
        .source .line-number {
            color: var(--color-medium);
            display: inline-block;
            width: 3rem;
            text-align: right;
            padding-right: 1rem;
            user-select: none;
            opacity: 0.7;
        }
        
        .tabs {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0 0 1rem 0;
            border-bottom: 1px solid var(--color-primary);
        }
        
        .tabs li {
            margin-right: 1rem;
        }
        
        .tabs a {
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 5px 5px 0 0;
            background: rgba(58, 66, 89, 0.3);
        }
        
        .tabs a:hover {
            background: rgba(0, 198, 255, 0.1);
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
            margin: 1rem 0;
        }
        
        table th, table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--color-primary);
        }
        
        table th {
            background: rgba(58, 66, 89, 0.5);
            color: var(--color-accent);
        }
        
        .alert {
            background: rgba(239, 35, 60, 0.2);
            border-left: 3px solid #ef233c;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 0 5px 5px 0;
        }
        
        .trace ol {
            list-style: none;
            padding-left: 0;
        }
        
        .trace li {
            padding: 1rem;
            margin-bottom: 1rem;
            background: rgba(58, 66, 89, 0.3);
            border-radius: 5px;
        }
        
        .args {
            display: none;
            margin-top: 1rem;
        }
        
        .args table {
            background: rgba(36, 45, 67, 0.7);
        }
        
        @media (max-width: 1200px) {
            .main-container {
                width: 85vw;
            }
        }
        
        @media (max-width: 992px) {
            .main-container {
                width: 90vw;
            }
            
            h1 {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            
            .main-container {
                width: 95vw;
            }
            
            .header, .container {
                padding: 1.5rem;
            }
            
            .tabs {
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>

<div class="main-container">
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
            <div class="content active" id="backtrace">

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
</div> <!-- /main-container -->

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

</body>
</html>