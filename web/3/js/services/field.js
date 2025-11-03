export const genFieldValue = (availibleFieldToGen) => {
    const fieldValue = availibleFieldToGen[Math.floor(Math.random() * availibleFieldToGen.length)];

    return fieldValue;
}

export const addFieldToRandomPlace = (fields, fieldValue) => {
    let value = 0;

    while (!value) {
        const randomIndexRow = Math.floor(Math.random() * fields.length);
        const randomIndexCol = Math.floor(Math.random() * fields[randomIndexRow].length);
    
        if(fields[randomIndexRow][randomIndexCol] === 0) {
            value = fieldValue;

            fields[randomIndexRow][randomIndexCol] = fieldValue
        };
    }
    
}