$("#from").attr("disabled" ,true);
$("#to").attr("disabled", true);


$("#type").on("change", function(){

    if($("#type").val() == 0){
        $("#from").attr("disabled", true);
        $("#to").attr("disabled", true);
    }else{
        $("#from").attr("disabled", false)
        $("#to").attr("disabled", false)
    }

})


$("#print_statement").on("click", function(){

    print_statement();

})

function print_statement(){

    let printArea = document.querySelector("#print_area");
    let newWindow = window.open("");
    newWindow.document.write(`<html><head><title></title>`);
    newWindow.document.write(`<style  media="print">


         @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
        
         font-family: "Poppins", serif;
        }
         .poppins-bold {
           font-family: "Poppins", serif;
           font-weight: 700;
           font-style: normal;
        }

        table {
        width: 100%;
        }
        th {
        background-color: #00b7f2 !important;
        color: white    !important;             
        }
        th, td{
        padding: 5px !important;
        text-align: left !important;
        }
        th, td{
        border-left: 1px solid #ddd  !important;
        
        border-bottom: 1px solid #ddd  !important;
        }
        
        
        
        
        </style>`);


    newWindow.document.write(`</head><body>`);
    newWindow.document.write(printArea.innerHTML);
    newWindow.document.write(`</body></html>`);
    newWindow.print();
    newWindow.close();    

}


$("#export_statement").on('click', function(){
    let file = new Blob([$('#print_area').html()], {type:"application/vnd.ms-excel"});
    let url = URL.createObjectURL(file);
    let a = $("<a />", {

        href: url,
        download: "print_statement.xls"}).appendTo("body").get(0).click();
        e.preventDefault();
})

// Get Student Report

$("#studentsReport").on("submit", function(event){
    event.preventDefault();

   $("#studentsTable thead").empty();
   $("#studentsTable tbody").empty();

   let from = $("#from").val();
   let to   = $("#to").val();

   

   let     sendingData = {
           
             "from": from,
             "to": to,
            "action": "Get_students_report"
       }



    $.ajax( {
        method : "POST",
        dataType: "JSON",
        url : "../api/regApi.php",
        data : sendingData,
        success: function(data){
            let status = data.status;
            let response= data.data;

            let tr = '';
            let th = '';
            if(status){

                th = "<tr>";
                for(let r in response[0]){
                    th += `<th>${r}</th>`;
                }
                th += "</tr>";
                $("#studentsTable thead").append(th);

                response.forEach(res => {
                    tr = "<tr>";
                    for(let r in res){
                        tr += `<td>${res[r]}</td>`;
                    }
                    tr += "</tr>";
                    $("#studentsTable tbody").append(tr);
                })
                
            }else{
               Alerts("error",response);
            }

        },
        error: function(data){
           console.error(data);

        }
    })
})


// load data

function load_data(){
    let sendingData = {
        "action" : "Students_info",
    }


    $.ajax( {

        method: "POST",
        dataType:"JSON",
        url: "../api/regApi.php",
        data: sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if(status){
                response.forEach(res =>{
                    tr += "<tr>";
    
                    for(let r in res){

                        if(r == "class"){
                            if(res[r] == "Form 4"){
                                tr +=`<td><span  class="badge text-bg-success">${res[r]}</span></td>`;
                            }else{
                                tr +=`<td><span  class="badge text-bg-light">${res[r]}</span></td>`;
                            }
                            
                        }else{
                        tr +=`<td>${res[r]}</td>`;
                        }
                        
                    }

                    tr +=`<td><a  class="btn btn-info update_info btn-sm" update_id=${res['id']}><i class="bi bi-pencil-square" style="color: #fff;"></i></a>
                    <a  class="btn btn-danger delete_info btn-sm" delete_id=${res['id']}><i class="bi bi-trash-fill" style="color: #fff;"></td>`;
    
                    tr += "</tr>";
                })
                $("#studentsTable  tbody").append(tr);

            }else{
                Alerts("error",response);

            }

        },
        error: function(data){

            alert(response);
        }
    })
}




// allerts

function Alerts(type,message){
    let success = document.querySelector(".alert-success");
    let error = document.querySelector(".alert-danger");


    if(type == "success"){
        error.classList = "alert alert-danger d-none";
        success.classList="alert alert-success";
        success.innerHTML = message;

        setTimeout(function(){

            
            success.classList= "alert alert-success d-none";
            $("#studentsForm")[0].reset();

        },3000);
    }
    else{
        error.classList ="alert alert-danger";
        error.innerHTML = message;
    }
}
