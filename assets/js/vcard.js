function showCard(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                var rep=JSON.parse(this.responseText);
                document.getElementById("cardname").value = rep.data.name;
                document.getElementById("cardnumber").value = rep.data.pan;
                document.getElementById("cardcvv").value = rep.data.cvv;
                document.getElementById("billingaddress").value = rep.data.address + " " +rep.data.city+ " " +rep.data.country;
                document.getElementById("cardzipcode").value = rep.data.postal_code;
                document.getElementById("cardid").value = rep.data.id;

                document.getElementById("classdelete").style="";
            }
        };
        xmlhttp.open("GET", "carddetails/" + str, true);
        xmlhttp.send();
    }
}

function showCardtrnx() {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                var rep=JSON.parse(this.responseText);
                if(rep.status==0) {
                    document.getElementById("cardtrans").innerHTML = "You have no card transactions.";
                }else {
                    var blist = rep['data'];
                    var htm="";
                    for (var i = 0; i < blist.length; i++) {
                        htm+= "<tr> <td>"+blist[i]['product']+"</td> <td>"+blist[i]['amount']+"</td> <td>"+blist[i]['created_at']+"</td> </tr>";
                    }
                    document.getElementById("translist").innerHTML=htm;

                    document.getElementById("transtable").style.display="block";
                    document.getElementById("sac").style.display="none";

                }
            }
        };
        xmlhttp.open("GET", "cardtransactions/" + str, true);
        xmlhttp.send();
    }
}

function darklightmode(state) {

    document.getElementById("mainbody").removeAttribute("class");

    if(state==0){
        document.getElementById("mainbody").setAttribute("class", "main-body leftmenu dark-theme");
    }else{
        document.getElementById("mainbody").setAttribute("class", "main-body leftmenu");
    }


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                var rep=JSON.parse(this.responseText);
                document.getElementById("dlm").setAttribute("onclick", "darklightmode("+!state+")");

            }
        };
        xmlhttp.open("GET", "darkmode", true);
        xmlhttp.send();
}


function darklightmode2(state) {

    document.getElementById("mainbody").removeAttribute("class");

    if(state==0){
        document.getElementById("mainbody").setAttribute("class", "main-body leftmenu dark-theme");
    }else{
        document.getElementById("mainbody").setAttribute("class", "main-body leftmenu");
    }


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
                var rep=JSON.parse(this.responseText);
                document.getElementById("dlm2").setAttribute("onclick", "darklightmode2("+!state+")");

            }
        };
        xmlhttp.open("GET", "darkmode", true);
        xmlhttp.send();
}

function sweetsuccess() {
    swal(
        {
            title: 'Well done!',
            text: 'You clicked the button!',
            type: 'success',
            confirmButtonColor: '#57a94f'
        }
    )
}