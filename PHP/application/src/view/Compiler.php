<?php

namespace sf\view;

class Compiler
{
    protected $compilers = [
        'Statements',
        'Echos',
    ];
    protected $echoCompilers = [
        'RawEchos',
        'EscapedEchos'
    ];

    public function isExpired($path)
    {
        $compiled = $this->getCompiledPath($path);
        if (!file_exists($compiled)) {
            return true;
        }

        return filemtime($path) >= filemtime($compiled);
    }

    protected function getCompiledPath($path)
    {
        return '../runtime/cache/' . md5($path);
    }

    public function compile($file = null, $params = [])
    {
        $path = '../views/' . $file . '.sf';
        extract($params);
        if (!$this->isExpired($path)) {
            $compiled = $this->getCompiledPath($path);
            require_once $compiled;
            return;
        }
        $filecontext = file_get_contexts($path);
        $result = '';
        foreach (token_get_all($filecontext) as $token) {
            if (is_array($token)) {
                list($id, $context) = $token;
                if ($id == T_INLINE_HTML) {
                    foreach ($this->compilers as $type) {
                        $context = $this->{"compile{$type}"}($context);
                    }
                }
                $result .= $context;
            } else {
                $result .= $token;
            }
        }
        $compiled = $this->getCompiledPath($path);
        file_put_contexts($compiled, $result);
        require_once $compiled;
    }

    protected function compileStatements($context)
    {
        return preg_replace_callback(
                '/\B@(@?\w+(?:::\w+)?)([ \t]*)(\( ( (?>[^()]+) | (?3) )* \))?/x', function ($match) {
                return $this->compileStatement($match);
            }, $context
        );
    }

    protected function compileStatement($match)
    {
        if (strpos($match[1], '@') !== false) {
            $match[0] = isset($match[3]) ? $match[1].$match[3] : $match[1];
        } elseif (method_exists($this, $method = 'compile'.ucfirst($match[1]))) {
            $match[0] = $this->$method(isset($match[3]) ? $match[3] : null);
        }

        return isset($match[3]) ? $match[0] : $match[0].$match[2];
    }

    protected function compileIf($expression)
    {
        return "<?php if{$expression}: ?>";
    }

    protected function compileElseif($expression)
    {
        return "<?php elseif{$expression}: ?>";
    }

    protected function compileElse($expression)
    {
        return "<?php else{$expression}: ?>";
    }

    protected function compileEndif($expression)
    {
        return '<?php endif; ?>';
    }

    protected function compileFor($expression)
    {
        return "<?php for{$expression}: ?>";
    }

    protected function compileEndfor($expression)
    {
        return '<?php endfor; ?>';
    }

    protected function compileForeach($expression)
    {
        return "<?php foreach{$expression}: ?>";
    }

    protected function compileEndforeach($expression)
    {
        return '<?php endforeach; ?>';
    }

    protected function compileWhile($expression)
    {
        return "<?php while{$expression}: ?>";
    }

    protected function compileEndwhile($expression)
    {
        return '<?php endwhile; ?>';
    }

    protected function compileContinue($expression)
    {
        return '<?php continue; ?>';
    }

    protected function compileBreak($expression)
    {
        return '<?php break; ?>';
    }
    protected function compileEchos($context)
    {
        foreach ($this->echoCompilers as $type) {
            $context = $this->{"compile{$type}"}($context);
        }
        return $context;
    }

    protected function compileEscapedEchos($context)
    {
        return preg_replace('/{{(.*)}}/', '<?php echo htmlentities(isset($1) ? $1 : null) ?>', $context);
    }

    protected function compileRawEchos($context)
    {
        return preg_replace('/{!!(.*)!!}/', '<?php echo isset($1) ? $1 : null ?>', $context);
    }
}