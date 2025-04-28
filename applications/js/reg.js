load_data();
btnAction = "Insert";

// show modal

$("#addNew").on("click", function(){
    $("#regModal").modal('show');
})

// registration

$("#studentsForm").on("submit", function(event){
    event.preventDefault();

    let name = $("#name").val();
    let phone = $("#phone").val();
    let classess = $("#Classes").val();
    let motherName = $("#motherName").val();
    let id = $("#id").val();

    let sendingData = {};

    if(btnAction == "Insert"){

        
         sendingData = {
        "name" : name,
        "phone" : phone,
        "class" : classess,
        "motherName" : motherName,
        "action" : "Registration",
   }

    }else{

            sendingData = {
            "id" : id,
            "name" : name,
            "phone" : phone,
            "class" : classess,
            "motherName" : motherName,
            "action" : "Update_student",
       }

    }



    $.ajax( {
        method : "POST",
        dataType: "JSON",
        url : "../api/regApi.php",
        data : sendingData,
        success: function(data){
            let status = data.status;
            let response= data.data;
            if(status){
                Allerts("success",response);
                btnAction = "Insert";
                $("#studentsTable tbody").empty();
                load_data();
            }else{
               Allerts("error",response);
            }

        },
        error: function(data){
            alert(response);

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
                response.forEach(res => {
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
                Allerts("error",response);

            }

        },
        error: function(data){

            alert(response);
        }
    })
}

// fetch data updated

function fetch_data_updated(id){

    let sendingData = {
        "action" : "updated_Students_info",
        "id" : id
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
                

                    btnAction = "Update";
                    $("#id").val(response['id']);
                    $("#name").val(response['name']);
                    $("#phone").val(response['phone']);
                    $("#Classes").val(response['class']);
                    $("#motherName").val(response['motherName']);
                    $("#regModal").modal('show');
                   
               

            }else{
                Allerts("error",response);

            }

        },
        error: function(data){

            alert(response);
        }
    })

}


function delete_student(id){
    let sendingData = {
        "action" : "Delete_Students_info",
        "id" : id
    }

    $.ajax ({ 
        method : "POST",
        dataType: "JSON",
        url : "../api/regApi.php",
        data : sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';
            if(status){
                Swal.fire({
                    title: "Good job!",
                    text: response,
                    icon: "success"
                  }).then(()=>{
                    $("#studentsTable tbody").empty();
                    load_data();
                  })
            }else{
                Swal.fire({
                    title: "error!",
                    text: response,
                    icon: "error"
                  })
            }
        },
        error: function(data){
            Swal.fire({
                title: "error!",
                text: response,
                icon: "error"
              })
        }
    })
}


// function delete_student(id){

//     let sendingData = {
//         "action" : "Delete_Students_info",
//         "id"  : id
//     }

//     $.ajax ( {
//         method : "POST",
//         dataType : "JSON",
//         url : "../api/regApi.php",
//         data : sendingData,
//         success: function(data){
//             let status = data.status;
//             let response = data.data;
//             let html = '';
//             let tr = '';
//             if(status){
//                 Swal.fire({
//                     title: "Good job!",
//                     text: response,
//                     icon: "success"
//                   }).then(() => {
//                     $("#userTable tr").empty();
//                     read_All_Users();
//                   });
//             }else{
//                 Swal.fire({
//                     title: "error!",
//                     text: response,
//                     icon: "error"
//                   });
//             }
//         },
//         error: function(){
//             Swal.fire({
//                 title: "Error",
//                 text: response,
//                 icon: "error"
//               });
//         }
//     })
// }
// allerts

function Allerts(type,message){
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

$("#studentsTable").on("click",".update_info",function(){
    let id = $(this).attr("update_id");
    $("#regModal").modal('show');
    fetch_data_updated(id);
   
})

$("#studentsTable").on("click",".delete_info",function(){
    let id = $(this).attr("delete_id");
    
    if(confirm("Are you sure you want to delete this student?")){

        delete_student(id);
    }
    
   
})
    






