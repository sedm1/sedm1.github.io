export const renderRecords = (root, records) => {
    let table = document.querySelector('table');
    if (!table) {
        table = document.createElement('table');
        table.className = 'records-table';
    }
    while (table.firstChild) {
        table.removeChild(table.firstChild);
    }
    const header = document.createElement('tr');
    ['#', 'ФИО', 'Дата', 'Очки'].forEach(text => {
        const th = document.createElement('th');
        th.textContent = text;
        header.appendChild(th);
    });
    table.appendChild(header);
    records
        .sort((a, b) => b.score - a.score)
        .slice(0, 10)
        .forEach((rec, i) => {
        const row = document.createElement('tr');
        const rank = document.createElement('td');
        rank.textContent = String(i + 1);
        row.appendChild(rank);
        const name = document.createElement('td');
        name.textContent = rec.name;
        row.appendChild(name);
        const date = document.createElement('td');
        date.textContent = rec.date;
        row.appendChild(date);
        const score = document.createElement('td');
        score.textContent = String(rec.score);
        row.appendChild(score);
        table.appendChild(row);
    });
    root.appendChild(table);
};
//# sourceMappingURL=records.js.map