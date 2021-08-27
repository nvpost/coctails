//
// rating_stars
//

document.addEventListener("DOMContentLoaded", function() {
    active_rating_star = document.querySelectorAll('.rating_star')
    active_rating_star.forEach(i=>{
        i.addEventListener('mouseover', mouseInActiveStar.bind())
        i.addEventListener('mouseout', mouseOutActiveStar.bind())
        i.addEventListener('click', setNewOwnRating.bind())
    })
});






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
    
    let raring_url =home_url+"components/add_rating.php"
    // console.log(raring_url)
    fetch(raring_url,{
        method: 'POST',
        body: JSON.stringify({n,coctail_id}) 
    }).then(res=>{
        return res.json()
    }).then(data=>{
        console.log(data)
        document.location.reload()
    })
}

document.querySelector('.rating_field').style.display='flex';


//
// rating_stars
//
