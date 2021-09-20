const app = document.querySelector('#app');

function addLinks() {
    const hrefs = document.querySelectorAll('a');
    console.log(hrefs);
    hrefs.forEach((a) => {
        a.addEventListener('click', async (e) => {
            e.preventDefault();
            
            if(a.href != null) {
                const res = await fetch(a.href);
                const data = await res.text()
                app.innerHTML = data
            }
        })
    })
}

addLinks();