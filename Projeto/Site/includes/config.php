<?php
// includes/config.php — dados partilhados e helpers

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function e($v)   { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function eur($v) { return number_format((float)$v, 0, ',', '.') . ' €'; }

$categorias = [
    'Motor'         => '⚙️',
    'Travagem'      => '🛑',
    'Suspensão'     => '🔩',
    'Elétrica'      => '⚡',
    'Arrefecimento' => '❄️',
    'Iluminação'    => '💡',
    'Pneus'         => '🛞',
    'Carroçaria'    => '🚗',
];

$parceiros = [
    ['cor' => 'c1', 'nome' => 'Leiria Peças',  'sigla' => 'LP', 'desc' => 'Peças originais e equivalentes', 'local' => 'Leiria',         'nota' => '4.8'],
    ['cor' => 'c2', 'nome' => 'Leiria Motors', 'sigla' => 'LM', 'desc' => 'Peças multimarca',              'local' => 'Marinha Grande', 'nota' => '4.6'],
    ['cor' => 'c3', 'nome' => 'Centro Auto',   'sigla' => 'CA', 'desc' => 'Peças e acessórios',            'local' => 'Leiria',         'nota' => '4.9'],
];

$lojas = [
    ['nome' => 'Leiria Peças',  'sigla' => 'LP', 'cor' => '#2563eb', 'tipo' => 'Loja', 'info' => 'Rua das Peças 12, Leiria',           'coords' => [39.743, -8.807], 'gmaps' => 'https://maps.google.com/?q=39.743,-8.807'],
    ['nome' => 'Leiria Motors', 'sigla' => 'LM', 'cor' => '#db2777', 'tipo' => 'Loja', 'info' => 'Av. da Liberdade 45, Marinha Grande', 'coords' => [39.752, -8.932], 'gmaps' => 'https://maps.google.com/?q=39.752,-8.932'],
    ['nome' => 'Centro Auto',   'sigla' => 'CA', 'cor' => '#059669', 'tipo' => 'Loja', 'info' => 'Parque Industrial, Leiria',           'coords' => [39.730, -8.780], 'gmaps' => 'https://maps.google.com/?q=39.730,-8.780'],
];

$pecas = [
    ['titulo' => 'Pastilhas de travão dianteiras', 'ref' => 'BRK-1024', 'cat' => 'Travagem',      'loja' => 'Leiria Peças',  'cor' => 'c1', 'preco' => 120, 'estado' => 'Novo'],
    ['titulo' => 'Filtro de óleo',                 'ref' => 'FLT-2210', 'cat' => 'Motor',         'loja' => 'Leiria Peças',  'cor' => 'c1', 'preco' => 15,  'estado' => 'Novo'],
    ['titulo' => 'Amortecedor traseiro',           'ref' => 'AMT-7781', 'cat' => 'Suspensão',     'loja' => 'Leiria Peças',  'cor' => 'c1', 'preco' => 95,  'estado' => 'Usado'],
    ['titulo' => 'Alternador 90A',                 'ref' => 'ALT-5540', 'cat' => 'Elétrica',      'loja' => 'Leiria Motors', 'cor' => 'c2', 'preco' => 210, 'estado' => 'Recondicionado'],
    ['titulo' => 'Radiador de água',               'ref' => 'RAD-3302', 'cat' => 'Arrefecimento', 'loja' => 'Leiria Motors', 'cor' => 'c2', 'preco' => 140, 'estado' => 'Novo'],
    ['titulo' => 'Farol dianteiro esquerdo',       'ref' => 'FAR-9910', 'cat' => 'Iluminação',    'loja' => 'Centro Auto',   'cor' => 'c3', 'preco' => 320, 'estado' => 'Novo'],
    ['titulo' => 'Pneu 205/55 R16',                'ref' => 'PNE-4408', 'cat' => 'Pneus',         'loja' => 'Centro Auto',   'cor' => 'c3', 'preco' => 85,  'estado' => 'Novo'],
];

$stock = [
    'c1' => [
        ['ref' => 'BRK-1024', 'titulo' => 'Pastilhas de travão dianteiras', 'cat' => 'Travagem',      'estado' => 'Novo',           'qtd' => 8, 'preco' => 120],
        ['ref' => 'FLT-2210', 'titulo' => 'Filtro de óleo',                 'cat' => 'Motor',         'estado' => 'Novo',           'qtd' => 2, 'preco' => 15],
        ['ref' => 'AMT-7781', 'titulo' => 'Amortecedor traseiro',           'cat' => 'Suspensão',     'estado' => 'Usado',          'qtd' => 0, 'preco' => 95],
    ],
    'c2' => [
        ['ref' => 'ALT-5540', 'titulo' => 'Alternador 90A',                 'cat' => 'Elétrica',      'estado' => 'Recondicionado', 'qtd' => 5, 'preco' => 210],
        ['ref' => 'RAD-3302', 'titulo' => 'Radiador de água',               'cat' => 'Arrefecimento', 'estado' => 'Novo',           'qtd' => 4, 'preco' => 140],
    ],
    'c3' => [
        ['ref' => 'FAR-9910', 'titulo' => 'Farol dianteiro esquerdo',       'cat' => 'Iluminação',    'estado' => 'Novo',           'qtd' => 1, 'preco' => 320],
        ['ref' => 'PNE-4408', 'titulo' => 'Pneu 205/55 R16',                'cat' => 'Pneus',         'estado' => 'Novo',           'qtd' => 5, 'preco' => 85],
    ],
];

$utilizadoresDemo = [
    'oficina@exemplo.pt' => ['nome' => 'Oficina Demo', 'pass' => '123456'],
    'demo@lisam.pt'      => ['nome' => 'Demo',         'pass' => 'demo'],
];