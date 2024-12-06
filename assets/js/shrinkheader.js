window.addEventListener("scroll",()=>{
    setTimeout(()=>{
        let header = document.querySelector(".latest-post .post-content");
        let position = header.getBoundingClientRect();
        
    if(position.top < 210){
        document.querySelector("div > .site-title").classList.add("site-title--hidden")
 
    } else{
        document.querySelector("div > .site-title").classList.remove("site-title--hidden")

    }
      
    },100)
})