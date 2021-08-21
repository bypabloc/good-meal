
export default (list) => {
    let string = '';

    for (const e in list) {
        string += `${e}:<br/>`

        for (const f of list[e]) {
            string += `- ${f}<br/>`
        }
    }

    return string;
}