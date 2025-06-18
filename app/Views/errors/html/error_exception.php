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