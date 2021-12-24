<?php

$html = '';

if (!isset($regra) || $regra == ''){
    $regra = 'warning';
}

if (isset($mensagem) && ($mensagem) != ''){
    $html = <<<TEXTO
<div class="alert alert-{$regra}" role="alert">
{$mensagem}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
</button>
</div>
TEXTO;
}

echo $html;