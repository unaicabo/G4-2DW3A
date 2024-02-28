document.addEventListener('DOMContentLoaded', init, false)

    let datos
    let table

    let pagecount = 1
    let lastpage = 0;

    async function init() {
        // Seleccionamos la tabla
        table = document.querySelector('#rankTable tbody')

        // Llamamos a la función de mostrar la tabla
        await renderTable()
    }

    async function renderTable() {

        // Petición Web para obtener los datos de las paginas
        let resp = await axios.get(window.location+"/"+pagecount)

        datos = await resp.data;
        let user_id = 0
        try {
            user_id = document.getElementById('user_id').value;
        } catch (error) {

        }

        let result = ''

        let dificultad_select = document.getElementById('dificultad_select')

        // Petición Web para obtener los datos de la dificultad
        let diff = await axios.get(window.location+"/filtro/"+dificultad_select.value+"/"+pagecount)

        // Cambiar la tabla según la dificultad
        document.addEventListener('change',changeDifficulty)
        switch (dificultad_select.value) {
            case 'facil':
                datos = diff.data
                break;
            case 'medio':
                datos = diff.data
                break;
            case 'dificil':
                datos = diff.data
                break;
            case 'heroe':
                datos = diff.data
                break;
            default:
        }

        let counter = 0

        // Crear la tabla
        datos.data.forEach((c,index) => {
            if (c.user_id == user_id) {
                if(counter%2==0){
                    result +=
                    `<tr class="rank-login">`
                }else{
                    result +=
                    `<tr class="rank-login bg-slate-100">`
                }
                
            } else {
                if(counter%2==0){
                    result +=
                    `<tr class="rank-no-login">`
                }else{
                    result +=
                    `<tr class="rank-no-login bg-slate-100">`
                }
            }

            if (index == 0 && pagecount == 1) {
                result+=`
                <td class="py-2 px-2 md:py-4 md:px-6 border-b border-gray-200">
                    <img src="img/gold.png" alt="gold" class="w-10 h-10">
                </td>`
            } else if (index == 1 && pagecount == 1) {
                result+=`
                <td class="py-2 px-2 md:py-4 md:px-6 border-b border-gray-200">
                    <img src="img/silver.png" alt="silver" class="w-10 h-10">
                </td>`
            } else if (index == 2 && pagecount == 1) {
                result+=`
                <td class="py-2 px-2 md:py-4 md:px-6 border-b border-gray-200">
                    <img src="img/bronze.png" alt="bronze" class="w-10 h-10">
                </td>`
            } else {
                result+=`
                <td class="py-2 px-4 md:py-4 md:px-8 border-b border-gray-200">
                    <img src="img/medal.png" alt="medal" class="w-6  h-6">
                </td>`
            }

            if (c.user_id == user_id) {
                result+=`
                    <td class='text-sm sm:text-base py-2 px-2 sm:py-4 sm:px-6 border-b border-gray-200 text-lime-500'>${(index+(pagecount-1)*6)+1}</td>
                    <td class='text-sm sm:text-base py-2 px-2 sm:py-4 sm:px-6 border-b border-gray-200 text-lime-500'>${c.user.name}</td>
                    <td class='text-xs sm:text-base py-2 px-4 sm:py-4 border-b border-gray-200 text-lime-500'>${c.tiempo}</td>
                    <td class='text-sm sm:text-base py-2 px-2 sm:py-4 sm:px-6 border-b border-gray-200 text-lime-500'>${c.errores}</td>
                    <td class='text-sm sm:text-base py-2 px-2 sm:py-4 sm:px-6 border-b border-gray-200 text-lime-500'>${c.dificultad}</td>
                </tr>`
            } else {
                result+=`
                    <td class='text-sm sm:text-base py-2 px-2 sm:py-4 sm:px-6 border-b border-gray-200'>${(index+(pagecount-1)*6)+1}</td>
                    <td class='text-sm sm:text-base py-2 px-2 sm:py-4 sm:px-6 border-b border-gray-200'>${c.user.name}</td>
                    <td class='text-xs sm:text-base py-2 px-4 sm:py-4 border-b border-gray-200'>${c.tiempo}</td>
                    <td class='text-sm sm:text-base py-2 px-2 sm:py-4 sm:px-6 border-b border-gray-200'>${c.errores}</td>
                    <td class='text-sm sm:text-base py-2 px-2 sm:py-4 sm:px-6 border-b border-gray-200'>${c.dificultad}</td>
                </tr>`
            }

            counter++;
        })
        table.innerHTML = result

        // Variables para la pagination
        lastpage = datos.last_page
        let lista = document.getElementById('listnumber')

        lista.innerHTML = ''

        // Crear el boton de pagina anterior
        let prevelement = `
        <li class="cursor-pointer">
            <a class="paginate-button rounded-s-lg">
                <span class="text-2xl pb-1.5"><</span>
            </a>
        </li>`
        let prevdiv = document.createElement('div')
        prevdiv.innerHTML = prevelement
        prevdiv.addEventListener('click',prevPage)
        lista.appendChild(prevdiv)

        // Crear los botones de los números de pagina
        for (let i = 1; i <= lastpage; i++) {
            let newelement = `
            <li class="cursor-pointer">
                <a class="paginate-button">
                    <span class="text-2xl pb-1.5">${i}</span>
                </a>
            </li>`
            let div = document.createElement('div')
            div.innerHTML = newelement
            div.addEventListener('click',getPage(i))
            lista.appendChild(div)
        }

        // Crear el botón de pagina siguiente
        let nextelement = `
        <li class="cursor-pointer">
            <a class="paginate-button rounded-e-lg">
                <span class="text-2xl pb-1.5">></span>
            </a>
        </li>`
        let nextdiv = document.createElement('div')
        nextdiv.innerHTML = nextelement
        nextdiv.addEventListener('click',nextPage)
        lista.appendChild(nextdiv)
    }

    // Función para pasar a una pagina concreta
    function getPage(page) {
        return function () {
            pagecount = page
            renderTable()
        }
    }

    // Función para pasar a la pagina anterior
    function prevPage() {
        if(pagecount > 1) pagecount--
        renderTable()
    }

    // Función para pasar a la pagina siguiente
    function nextPage() {
        if((pagecount+1) <= lastpage) pagecount++
        renderTable()
    }

    // Función para que se ponga en la pagina 1 al cambiar la dificultad
    function changeDifficulty() {
        pagecount = 1
        renderTable()
    }
