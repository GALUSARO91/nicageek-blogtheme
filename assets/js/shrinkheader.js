window.addEventListener("scroll",()=>{
    setTimeout(()=>{
    if(document.documentElement.scrollTop > 150){
        document.querySelector("div > .site-title").classList.add("site-title--hidden")
 
    } else{
        document.querySelector("div > .site-title").classList.remove("site-title--hidden")

    }
      
    },100)
})