<?php
require_once (__DIR__.'/crest.php');
require_once (__DIR__.'/settings.php');

$installResult = CRest::installApp();
if (!$installResult['install'] && $installResult['rest_only'] === false) {
    die('Ошибка установки приложения');
}

$minAmount = 0;
$deals = [];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['min_amount'])) {
    $minAmount = (float)$_POST['min_amount'];
}

$result = CRest::call(
    'crm.deal.list',
    [
        'select' => [
            'ID',
            'title',
            'OPPORTUNITY',
        ],
        'filter' => [
            '>OPPORTUNITY' => $minAmount,
        ]
    ]
);

if (isset($result['error'])) {
    $error = 'Ошибка при получении данных: ' . $result['error'];
} else {
    $deals = $result['result'] ?? [];
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список сделок - Bitrix24</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Список сделок</h1>

    <div class="filter-form">
        <form method="POST" action="">
            <div class="filter-group">
                <div class="form-group">
                    <label for="min_amount">Минимальная сумма:</label>
                    <input type="number"
                           id="min_amount"
                           name="min_amount"
                           value="<?php echo htmlspecialchars($minAmount); ?>"
                           step="0.01"
                           min="0"
                           placeholder="Введите минимальную сумму">
                </div>
                <button type="submit">Показать</button>
                <?php if ($minAmount > 0): ?>
                    <a href="?" class="reset-btn" style="text-decoration: none; display: inline-block;">
                        <button type="button">Сбросить</button>
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <div class="stats">
        <strong>Найдено сделок:</strong> <?php echo count($deals); ?>
        <?php if ($minAmount > 0): ?>
            | <strong>Фильтр:</strong> сумма > <?php echo number_format($minAmount, 2, '.', ' '); ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($deals)): ?>
        <table class="deals-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название сделки</th>
                <th>Сумма</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($deals as $deal): ?>
                <tr>
                    <td><strong>#<?php echo htmlspecialchars($deal['ID']); ?></strong></td>
                    <td><?php echo htmlspecialchars($deal['TITLE'] ?: 'Без названия'); ?></td>
                    <td>
                                <span class="currency">
                                    <?php echo number_format(floatval($deal['OPPORTUNITY']), 2, '.', ' '); ?>
                                </span>
                        <?php if (!empty($deal['CURRENCY_ID'])): ?>
                            <small>(<?php echo htmlspecialchars($deal['CURRENCY_ID']); ?>)</small>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="no-deals">
            <?php if ($minAmount > 0): ?>
                <p>Сделок с суммой более <?php echo number_format($minAmount, 2, '.', ' '); ?> не найдено</p>
                <p><small>Попробуйте изменить значение фильтра</small></p>
            <?php else: ?>
                <p>Сделки не найдены или произошла ошибка при загрузке данных</p>
                <p><small>Проверьте подключение к Bitrix24 и права доступа</small></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>


<script src="script.js"></script>
</body>
</html>