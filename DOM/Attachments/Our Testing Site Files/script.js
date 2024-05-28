const body_color = document.querySelector(".change-color");
var count = 0;
body_color.addEventListener("click",function()
{
    if(count == 0)
        {
            document.body.style.background = '#e3b6b3'; 
            count++;
        }
    else{
        setTimeout(() => document.body.style.background = '', 50); // return back
        count--;
    }

});


const add_heading = document.querySelector(".add-h1");
var count1 = 0;
add_heading.addEventListener("click",function()
{
    if(count1 == 0)
        {
            const h1 = document.createElement('h1');
               h1.className = "insert";
               h1.innerHTML = "<strong>H1</strong> Created";
             document.body.appendChild(h1);
             count1++;
        }
    else{
        const h1 = document.querySelector("h1");
        setTimeout(() => h1.remove(), 50);
        count1--;
    }

});