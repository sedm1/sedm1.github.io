export const genFieldValue = (availibleFieldToGen: number[]) => {
    const fieldValue = availibleFieldToGen[Math.floor(Math.random() * availibleFieldToGen.length)];

    return fieldValue;
}

export const addFieldToRandomPlace = (fields: number[][], fieldValue: number) => {
    let value = 0;

    while (!value) {
        const randomIndexRow = Math.floor(Math.random() * fields.length);
        const randomIndexCol = Math.floor(Math.random() * fields[randomIndexRow].length);

        if (fields[randomIndexRow][randomIndexCol] === 0) {
            value = fieldValue;

            fields[randomIndexRow][randomIndexCol] = fieldValue
        };
    }
}

export const isFull = (fields: number[][]) => {
    let isFull = true;

    fields.forEach((fieldRow) => {
        fieldRow.forEach((field) => {
            if (field === 0) isFull = false;
        })
    })

    return isFull;
}