const error = document.querySelector('.error');
const errorText = document.querySelector('.error__text');
const form = document.querySelector('form');
const btn = form.querySelector('.form-button');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const params = new URLSearchParams(new FormData(form));
    btn.disabled = true;
    clearMessage();

    try {
        const response = await fetch('/api/tasks?' + params.toString(), {
            method: 'GET'
        });

        if (response.status === 204) throw new Error('Таких задач нет');
        if (response.status === 500) throw new Error('Неизвестная ошибка на сервере');

        const json = await response.json();
        const csv = convertJSONToCSV(json);

        downloadFile(csv);
    } catch (err) {
        showMessage(err.message);
    } finally {
        btn.disabled = false;
    }
});

function downloadFile(data) {
    const blob = new Blob([data], { type: 'text/csv;charset=utf-8;' });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'tasks.csv';
    a.click();
}

function convertJSONToCSV(data) {
    const headers = Object.keys(data[0]); // Получаем заголовки
    const csvRows = [];

    // Добавляем заголовки
    csvRows.push(headers.join(','));

    // Добавляем строки данных
    for (const row of data) {
        const values = headers.map(header => {
            const escaped = ('' + row[header]).replace(/"/g, '\\"'); // Экранирование кавычек
            return `"${escaped}"`; // Оборачиваем в кавычки для безопасности
        });
        csvRows.push(values.join(','));
    }

    return csvRows.join('\n');
}

function showMessage(message) {
    error.style.display = 'block';
    errorText.innerHTML = message;
}

function clearMessage() {
    error.style.display = 'none';
    errorText.innerHTML = '';
}
