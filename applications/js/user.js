read_All_Users();
btnAction = "Insert";


//image reader

let fileImage = document.querySelector("#image");
let showImage = document.querySelector("#show");

const reader = new FileReader();

fileImage.addEventListener("change", (e) => {

    const selectedFile = e.target.files[0];
    reader.readAsDataURL(selectedFile);
})

reader.onload = e => {
    showImage.src = e.target.result;
}

//user registaration

$("#addNew").on("click", function(){
    $("#userModal").modal('show');
})


$("#userForm").on("submit", function(event){
    event.preventDefault();

    let form_data = new FormData($("#userForm")[0]);
    form_data.append("image", $("input[type=file]")[0].files[0]);

    if(btnAction == "Insert"){
        form_data.append("action","user_reg");

    }else{

        form_data.append("action","update_users");
    }



    $.ajax({

        method: "POST",
        dataType: "JSON",
        url: "../api/user.php",
        data: form_data,
        processData: false,
        contentType: false,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if(status){
                Allerts("success",response);
                btnAction ="Insert";
                $("#userTable tr").empty();
                read_All_Users();
            }else{
                Allerts("error",response);
            }

        },
        error: function(data){

            Allerts("error",data);
 
            

        }
        

    })

})


//load read ALldata

function read_All_Users(){

    let sendingData = {
        "action" : "load_all_users",
    }

    $.ajax({

        method: "POST",
        dataType: "JSON",
        url: "../api/user.php",
        data: sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if(status){

                response.forEach(res => {

                    th = "<tr>";
                    for(let i in res){
                        th += `<td>${i}</td>`;
                    }

                    th += "<th>Action</th></tr>";

                    tr += "<tr>";

                    for(let r in res){
                        if(r == "image"){
                            tr += `<td><image  style=" width: 50px; height: 50px; border: solid 1px #744547; border-radius: 50%; object-fit: cover;"  src="../uploads/${res[r]}"></td>`;
                        }else{
                            tr += `<td>${res[r]}</td>`;
                        }
                    }

                    tr +=`<td><a  class="btn btn-info update_info btn-sm" update_id=${res['id']}><i class="bi bi-pencil-square" style="color: #fff;"></i></a>
                    <a  class="btn btn-danger delete_info btn-sm" delete_id=${res['id']}><i class="bi bi-trash-fill" style="color: #fff;"></td>`;

                    tr += "</tr>";
                })

                $("#userTable thead").append(th);
                $("#userTable tbody").append(tr);


               
            }else{
                Allerts("error",response);
            }

        },
        error: function(data){

            console.error(data);

        }
   
    })

}


// fetch user info on the modal request
function fetch_user_info(id){
    let sendingData = {
        "action" : "get_user_info",
        "id"  : id
    }


    $.ajax ({
        method : "POST",
        dataType: "JSON",
        url : "../api/user.php",
        data : sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if(status){
                
                btnAction = "Update";
                $("#id").val(response['id']);
                $("#username").val(response['username']);
                $("#show").attr('src', `../uploads/${response['image']}`);
                $("#userModal").modal("show");
            }else{
                Allerts("error", response);
            }

        },
        error: function(data){
            Allerts("error", data);
        }
    })
}


//delete user request
function delete_user(id){

    let sendingData = {
        "action" : "delete_user",
        "id"  : id
    }

    $.ajax ( {
        method : "POST",
        dataType : "JSON",
        url : "../api/user.php",
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
                  }).then(() => {
                    $("#userTable tr").empty();
                    read_All_Users();
                  });
            }else{
                Swal.fire({
                    title: "error!",
                    text: response,
                    icon: "error"
                  });
            }
        },
        error: function(){
            Swal.fire({
                title: "Error",
                text: response,
                icon: "error"
              });
        }
    })
}






//  displaying alert messages

function Allerts(type,message){
    let success = document.querySelector(".alert-success");
    let error = document.querySelector(".alert-danger");


    if(type == "success"){
        error.classList = "alert alert-danger d-none";
        success.classList="alert alert-success";
        success.innerHTML = message;

        setTimeout(function(){

            
            success.classList= "alert alert-success d-none";
            $("#userForm")[0].reset();

        },3000);
    }
    else{
        error.classList ="alert alert-danger";
        error.innerHTML = message;
    }
}



$("#userTable").on("click","a.update_info", function(){

    let id = $(this).attr("update_id");
    $("#userModal").modal("show");
    fetch_user_info(id);
});

$("#userTable").on("click","a.delete_info", function(){
    let id = $(this).attr("delete_id");
    if(confirm("Are you sure to delete this user?")){
        delete_user(id);
    }
});