const slideLeft = (row, length) => {
    let r = row.slice().filter(n => n !== 0);
    for (let i = 0; i < r.length - 1; i++) {
        if (r[i] === r[i + 1]) {
            r[i] *= 2;
            r[i + 1] = 0;
        }
    }
    r = r.filter(n => n !== 0);
    while (r.length < length)
        r.push(0);
    return r;
};
export const slideBoard = (action, fields) => {
    const rows = fields.length;
    const cols = fields[0].length;
    const setCell = (r, c, value) => {
        fields[r][c] = value;
    };
    if (action === "left" || action === "right") {
        fields.forEach((orig, r) => {
            let row = orig.slice();
            if (action === "right")
                row.reverse();
            const newRow = slideLeft(row, cols);
            if (action === "right")
                newRow.reverse();
            newRow.forEach((val, c) => setCell(r, c, val));
        });
    }
    else if (action === "up" || action === "down") {
        for (let c = 0; c < cols; c++) {
            let col = Array.from({ length: rows }, (_, r) => fields[r][c]);
            if (action === "down")
                col.reverse();
            const newCol = slideLeft(col, rows);
            if (action === "down")
                newCol.reverse();
            newCol.forEach((val, r) => setCell(r, c, val));
        }
    }
};
//# sourceMappingURL=slide.js.map