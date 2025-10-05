document.addEventListener('DOMContentLoaded', function() {
    const resetBtn = document.querySelector('.reset-btn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function(e) {
            if (!confirm('Сбросить фильтр и показать все сделки?')) {
                e.preventDefault();
            }
        });
    }

    // Фокус на поле ввода при загрузке
    const minAmountInput = document.getElementById('min_amount');
    if (minAmountInput) {
        minAmountInput.focus();
    }
});