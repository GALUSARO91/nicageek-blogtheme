
window.addEventListener("DOMContentLoaded",function(){
    let form = document.getElementById("rating-form")
    let radios = document.querySelectorAll("input[name='rating']")
        radios.forEach(element => {
            element.addEventListener("change",(e)=>{
                let formData = new FormData(form)
                let parsedData = new URLSearchParams(formData)
                fetch(`${ngbt.endpoint}/rating`,{
                    method: "POST",
                    body: parsedData
                }).then(res=>res.json())
                .then(json=>{
                    this.alert(json[0].msg)
                    if(json[0].rating){
                        reset_ranking_value(json[0].rating)
                    }
                
                }).catch(err=>{
                    console.error(`Hay un error${err}`)
                })

            })
        });
        
    
})


function reset_ranking_value(rating){
    let radios = document.querySelectorAll("input[name='rating']")
    radios.forEach(element => {
        if(element.value == rating){
            element.checked = true
        }
    })

}


