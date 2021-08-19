//
// rating_stars
//
active_rating_star = document.querySelectorAll('.rating_star')
active_rating_star.forEach(i=>{
    i.addEventListener('mouseover', mouseInActiveStar.bind())
    i.addEventListener('mouseout', mouseOutActiveStar.bind())
    i.addEventListener('mouseover', setNewOwnRating.bind())
})

function mouseInActiveStar(e){
    el = e.target
    let n = el.getAttribute('data-star')
    if(el.classList.value.indexOf('active_star')==-1){
        for ($i=1; $i<=n; $i++){
            let s = document.querySelector("[data-star='"+$i+"']")
            s.classList.add('hovered')
        }

    }
}

function mouseOutActiveStar(e){
    document.querySelectorAll('.rating_star.hovered').forEach(i=>{
        i.classList.remove('hovered')
    })
}

function setNewOwnRating(e){
    let n = e.target.getAttribute('data-star')
    console.log("Присвоим рейтинг", n)
}

document.querySelector('.rating_field').style.display='block';


//
// rating_stars
//