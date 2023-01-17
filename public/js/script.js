document.addEventListener("DOMContentLoaded", function() {
    var element = document.getElementById("usernameLink");
    showReviews(element.textContent);
    showOrders(element.textContent);
});

function showReviews(username) {
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const myObj = JSON.parse(this.responseText);
            let text = "";
            for (let x in myObj) {
                text += '<div class="card" style="width: 25vw;margin-left: auto;margin-right: auto">'+
                    '<div class="card-body">' +
                        '<h5 class="card-title ">Posted by: ' + myObj[x].userName + '</h5>' +
                        '<p class="card-text" style="padding-top: 0;padding-left: 0;padding-right: 0;">Rating: ' + myObj[x].rating +  '</p>' +
                        '<p class="card-text" style="padding-top: 0;padding-left: 0;padding-right: 0;">Comment: '+ myObj[x].comment +'</p>' +
                    '</div>'+
                '</div>';
            }
            document.getElementById("reviewField").innerHTML = text;
        }
    }
    xhttp.open("POST", "?c=review&a=getUserReviews&userName=" +username, true);
    xhttp.send();
}

function showOrders(username) {
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const myObj = JSON.parse(this.responseText);
            let text = "";
            for (let x in myObj) {
                text += '<div class="card" style="width: 25vw;margin-left: auto;margin-right: auto">'+
                    '<div class="card-body">' +
                    '<h5 class="card-title ">Ordered on: ' + myObj[x].order_date + '</h5>' +
                    '<p class="card-text" style="padding-top: 0;padding-left: 0;padding-right: 0;">'+ myObj[x].food_name + "   " + myObj[x].count+"x" +  '</p>' +
                    '<p class="card-text" style="padding-top: 0;padding-left: 0;padding-right: 0;">Price: '+ myObj[x].count * myObj[x].food_price + "$" +'</p>' +
                    '</div>'+
                    '</div>';
            }
            document.getElementById("orderField").innerHTML = text;
        }
    }
    xhttp.open("POST", "?c=cart&a=getUserOrders&userName=" +username, true);
    xhttp.send();


}




window.onload = function () {
    let name = document.getElementById("nameInput");
    let password = document.getElementById('passwordInput');
    let button = document.getElementById('registerButton');
    let form =  document.getElementById('registrationForm');
    let x = false;
    let y = false;
    let passed = 0;
    let passwordError = "";
    button.style.visibility = 'hidden';

    form.addEventListener("input",formCheck );


    function formCheck(e) {
        passed = 0;
        x = false;
        y = false;
        passwordError = "";
        let passwordValue = password.value;
        if (name.validity.tooShort) {
            name.setCustomValidity("Name must be between 5 to 10 characters long");
            name.reportValidity();
            x = false;
        } else {
            x = true;
            name.setCustomValidity("");
        }

        if (password.validity.tooShort) {
            passwordError = passwordError.concat("Too short") ;
            y = false;
        } else {
            password.setCustomValidity("");
        }
        if (passwordCheck(passwordValue) < 4) {
            passwordError = passwordError.concat(" ,too simple, use capital letters, special chars and numbers") ;

        } else {
            y = true;
        }
        if  (document.activeElement == password) {
            password.setCustomValidity(passwordError);
            password.reportValidity();
        }

        if (x == true && y == true) {
            button.style.visibility = 'visible';
        } else {
            button.style.visibility = 'hidden';
        }



    }
    function passwordCheck(passwordValue) {

        if((new RegExp ("[A-Z]").test(passwordValue))) {
           passed++;
        }
        if((new RegExp ("[a-z]").test(passwordValue))) {
           passed++;
        }
        if((new RegExp ("[0-9]").test(passwordValue))) {
            passed++;
        }
        if((new RegExp ("[$@$!%*#?&]").test(passwordValue))) {
            passed++;
        }
        return passed;
    }


}

function addItem(id,username,foodName,foodPrice) {

    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("txtHint").innerHTML += this.responseText.username;
        }
    };
    xhttp.open("POST", "?c=cart&a=store&userName="+username+"&foodId="+id+"&foodName="+foodName+"&foodPrice="+foodPrice, true);
    xhttp.send();

}

function showCart(username) {
    var cartScreen = document.getElementById("cartScreen");
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const myObj = JSON.parse(this.responseText);
            let text = "";
            let total = 0;
            for (let x in myObj) {
                text += '<div class="row " style="background-color: white;"id="cartContent">' +
                            '<div class="col-sm-4" id="cartText" >' + myObj[x].food_name + '</div>' +
                            '<div class="col-sm-4" id="cartText">' + myObj[x].food_price +'$' +'</div>' +
                            '<div class="col-sm-4" id="cartText">' + myObj[x].count + 'x' + '</div>' +
                            '<div class="col-sm-4" id="cartText"> ' +
                                '<a href="#" class="btn btn-primary" onclick="removeItem('+ "'" + username + "'" + "," + "'" + myObj[x].food_id + "'" +')">-</a> ' +
                                '<a href="#" class="btn btn-primary" onclick="addItemToCart('+ "'" + myObj[x].food_id + "'" + "," + "'" + username + "'" + "," +"' '"+ "," + "'0'" +')">+</a> ' +
                            '</div>' +
                        '</div>';
                total += myObj[x].food_price * myObj[x].count;
            }
            total = Math.round(total * 100) / 100;
            text += '<div class="row " style="background-color: white;" id="cartContent">' +
                '<div class="col-sm-4" id="cartText">Total: ' + total + '$'+ '</div>' +
                '</div>';
            text+= '<a href="?c=cart&a=order&userName=' + username + '" class="btn btn-primary">Order</a>';
            document.getElementById("cartContent").innerHTML = text;
        }
    };
    xhttp.open("POST", "?c=cart&userName="+username, true);
    xhttp.send();
    cartScreen.style.visibility = "visible";
}

function hideCart() {
    var cartScreen = document.getElementById("cartScreen");
    cartScreen.style.visibility = "hidden";
}

function removeItem(username,id) {
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showCart(username);
        }
    }
    xhttp.open("POST", "?c=cart&a=delete&userName=" +username+"&foodId="+id , true);
    xhttp.send();
}


function addItemToCart(id,username,foodName,foodPrice) {

    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            showCart(username);
        }
    };
    xhttp.open("POST", "?c=cart&a=store&userName="+username+"&foodId="+id+"&foodName="+foodName+"&foodPrice="+foodPrice, true);
    xhttp.send();
}


function register() {
    var nameInput = document.getElementById("nameInput");
    var passwordInput = document.getElementById("passwordInput");
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const myObj = JSON.parse(this.responseText);
            alert(myObj);
            if (myObj == "Success!") {
                nameInput.value = "";
                passwordInput.value = "";
            }

        }
    };
    xhttp.open("POST", "?c=user&a=store&username="+ nameInput.value + "&password="+passwordInput.value, true);
    xhttp.send();
}






