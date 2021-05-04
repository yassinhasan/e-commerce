

$(document).ready( function () {
    $('table').DataTable();
} );


var sidebar = document.querySelector(".sidebar");
var content = document.querySelector(".content");
var dashicon = document.querySelector(".dash-icon");
var mainnavbar = document.querySelector(".mainnavbar");
var all_nav_menu = document.querySelectorAll(".sidebar-nav-link");
var sidebar_nav_link_dropdown = document.querySelectorAll(".sidebar-nav-menu-item-link");
var dropdown_menu = document.querySelectorAll(".dropdown-menu");
var breadcrumb_list = document.querySelectorAll(".breadcrumb-link");

var body = document.getElementById('allbody');
dashicon.onclick = function()
{
  
    this.classList.toggle("toggle");
    sidebar.classList.toggle("hide");
    content.classList.toggle("full");
}

window.onscroll = function()
{
    if(window.pageYOffset >= 100)
    {
        mainnavbar.classList.add("sticky")
    }
    else
    {
        mainnavbar.classList.remove("sticky")  
    }
}

function close_all_nav_menu()
{

    var active = document.querySelectorAll(".active");
    for(var x = 0 ; x < active.length ; x++)
    {
        active[x].classList.remove("active");
        
    }

}

all_nav_menu.forEach(function(e){
    e.onclick = function (){
        close_all_nav_menu();
        this.classList.add("active");
            if(this.nextElementSibling)
            {
                    close_all_nav_menu();
                     this.classList.add("active");
                this.nextElementSibling.classList.toggle("expand");  

            }
    }
})

//close errros messages

const close_i_errors = document.querySelectorAll(".all_messages i");

close_i_errors.forEach((e)=>
{
    e.addEventListener("click",()=>
    {
        e.offsetParent.classList.add("hide");
    })
})



//ajax



function test()
{
    var usernamefield = document.querySelector("input[name=username]");
    if( null != usernamefield)
    {
        usernamefield.addEventListener("blur",function()
        {
            var req = new XMLHttpRequest();
            req.onload =function()
            {
                if(this.readyState == 4 && this.status == 200)
                {
                    var responseicon = document.createElement("i");
                    var alreadyexists = document.createElement("span");
                    var mainp = document.createElement("p");
                    
                    if(req.responseText == 1)
                    {
                        mainp.className = "exists";
                        responseicon.className = "fas fa-times";
                        alreadyexists.appendChild(document.createTextNode("this username is already exists"));                    
                    } 
                    else if(req.responseText == 2)
                    {
                        mainp.className = "notexists";
                        responseicon.className = "fas fa-check";
                        alreadyexists.appendChild(document.createTextNode("this username is ok"));      
                    } 
                    var elements = usernamefield.parentNode.childNodes;

                    for( var x= 0 ; x < elements.length ; x++)
                    {
                        if(elements[x].nodeName.toLocaleLowerCase() == "p")
                        {
                            elements[x].parentNode.removeChild(elements[x])
                        }
                    }

                    usernamefield.parentNode.appendChild(mainp);
                    mainp.appendChild(responseicon);
                    mainp.appendChild(alreadyexists);
                    

                }
            }
            req.open("POST","http://e-commerce/users/checkuserajaxrequest");
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.send("username=" + this.value);
        })
    }
}
function test2()
{
    var useremail= document.querySelector("input[name=email]");
    console.log(useremail)
    if( null != useremail)
    {
        useremail.addEventListener("blur",function()
        {
            var req = new XMLHttpRequest();
            req.onload =function()
            {
                if(this.readyState == 4 && this.status == 200)
                {
                    var responseicon = document.createElement("i");
                    var alreadyexists = document.createElement("span");
                    var mainp = document.createElement("p");
                   
                    if(req.responseText == 1)
                    {
                        responseicon.className = "fas fa-times";
                        mainp.className = "exists";
                        alreadyexists.appendChild(document.createTextNode("this email is already exists"));
                       
                    
                    } 
                    else if(req.responseText == 2)
                    {
                        responseicon.className = "fas fa-check";
                        mainp.className = "notexists";
                        alreadyexists.appendChild(document.createTextNode("this email is ok"));
                    } 
                    var elements = useremail.parentNode.childNodes;

                    for( var x= 0 ; x < elements.length ; x++)
                    {
                        if(elements[x].nodeName.toLocaleLowerCase() == "p")
                        {
                            elements[x].parentNode.removeChild(elements[x])
                        }
                    }

                    useremail.parentNode.appendChild(mainp);
                    mainp.appendChild(responseicon);
                    mainp.appendChild(alreadyexists);
                  
                }
            }
            req.open("POST","http://e-commerce/users/checkuserajaxrequest");
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.send("email=" + this.value);
        })
    }
}
test();
test2();


// To POST data like an HTML form, add an HTTP header with setRequestHeader(). Specify the data you want to send in the send() method:

// Example
// xhttp.open("POST", "ajax_test.asp", true);
// xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// xhttp.send("fname=Henry&lname=Ford");


//auth