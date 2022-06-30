// Eliminar el cuadro de agregar post en la pestaña social activity
if(document.querySelector('.um-activity-publish')){
    document.querySelector('.um-activity-publish').style.display = 'none';
}

// Cambiar el texto del campo de agregar imagen
if(document.querySelector('#featured_image')){
    document.querySelector('#featured_image :nth-child(2)').firstChild.textContent = 'Clic para añadir imagen';
}

const origen = location.origin;
const path = location.pathname;
const array = path.split('/');
const uri = origen + '/' + array[1];

// Cambiar el texto de la pestaña de actividad
if(uri == 'https://www.leogratis.com/user'){
    document.querySelector('.um-profile-nav-activity > a:nth-child(2) > span').textContent = 'Libros';
}

// Rellenar y ocultar los campos del formulario del front que el usuario desee. 
const slugId  = MODPER_const.slugs.split(',');
const valores = MODPER_const.valores.split(',');
let i = 0;
slugId.forEach(slug => {

    if(document.querySelector(`#${slug}`)){
        document.querySelector(`#${slug}`).style.display = 'none';
        document.querySelector(`#${slug}`).value = `${valores[i]}`;
        i++;
    }else{
        i++;
    }

}); 

