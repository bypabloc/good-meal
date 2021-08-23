
const list = [
    { id: 1, text: 'Google', },
    { id: 2, text: 'Facebook', },
    { id: 3, text: 'Twitter', },
    { id: 4, text: 'Un amigo', },
]

const object = {
    1: { text: 'Google', },
    2: { text: 'Facebook', },
    3: { text: 'Twitter', },
    4: { text: 'Un amigo', },
    404: { text: 'No encontrado', },
}

class CanalMarketing {
    
    constructor( args = {} ) {
        ( { id: this.id = null, text: this.text = null } = args );
    }
 
    findAll () {
        return list.map(e => new CanalMarketing(e));
    }
 
    findById (id) {
        return object[id] || object[404];
    }
}

export default CanalMarketing