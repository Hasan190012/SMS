load_category();
btnAction = "Insert";


$("#addCategory").on("click", function(){
    $("#categoryModal").modal("show");
})

$("#categoryForm").on("submit", function(event){
    event.preventDefault();

    let name = $("#name").val();
    let icon = $("#icon").val();
    let role = $("#role").val();
    let id = $("#id").val();

    let sendingData = {}
    
    if(btnAction == "Insert"){
        sendingData = {
            "name" : name,
            "icon" : icon,
            "role" : role,
            "action" : "cotegory_Regsitration"
        }
    }else{
        sendingData = {
            "id" : id,
            "name" : name,
            "icon" : icon,
            "role" : role,
            "action" : "update_category"
        }
    }

    $.ajax( {
        method : "POST",
        dataType : "JSON",
        url : "../api/category.php",
        data : sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr  = '';
            if(status){
                Allerts("success", response);
                btnAction = "Insert";
                $("#categoryTable tbody").empty();
                load_category();
            }else{
                Allerts("error", response);
            }
        },
        error : function(data){
            Allerts("error", data.responseText);
        }
    })
})

function load_category(){
    let sendingData = {
        "action" : "load_category"
    }

    $.ajax({ 
        method : "POST",
        dataType : "JSON",
        url : "../api/category.php",
        data : sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let  tr = '';
            if(status){
                response.forEach(res => {
                    tr += "<tr>";

                    for(let r in res){

                        if(r == "role"){
                           if(res[r] == "superAdmin"){
                            tr +=`<td><span  class="badge text-bg-success">${res[r]}</span></td>`;
                           }else{
                            tr +=`<td><span  class="badge text-bg-primary">${res[r]}</span></td>`;
                           }
                        }else{
                            tr += `<td>${res[r]}</td>`;
                        }
                    }

                    tr +=`<td><a  class="btn btn-info update_info btn-sm" update_id=${res['id']}><i class="bi bi-pencil-square" style="color: #fff;"></i></a>
                    <a  class="btn btn-danger delete_info btn-sm" delete_id=${res['id']}><i class="bi bi-trash-fill" style="color: #fff;"></td>`;

                    tr += "</tr>";
                })

                $("#categoryTable tbody").append(tr);
            }else{
                Allerts("error", response);
            }
        },
        error: function(data){
            Allerts("error", data.responseText);
        }
    })
}

function fetch_category_info(id){
    let sendingData = {
        "action" : "fetch_category_info",
        "id" : id
    }

    $.ajax( { 
        method : "POST",
        dataType : "JSON",
        url : "../api/category.php",
        data : sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';
            if(status){
                
                btnAction = "Update";
                $("#id").val(response['id']);
                $("#name").val(response['name']);
                $("#icon").val(response['icon']);
                $("#role").val(response['role']);
                $("#categoryModal").modal("show");
            }else{
                Allerts("error", response)
            }
        },
        error: function(data){
            Allerts("error", response);
        }
    })
}
function delete_category(id){
    let sendingData = {
        "action" : "delete_category",
        "id" : id
    }

    $.ajax ({ 
        method : "POST",
        dataType: "JSON",
        url : "../api/category.php",
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
                    $("#categoryTable tbody").empty();
                    load_category();
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


function Allerts(type,message){
    let success = document.querySelector(".alert-success");
    let error = document.querySelector(".alert-danger");


    if(type == "success"){
        error.classList = "alert alert-danger d-none";
        success.classList="alert alert-success";
        success.innerHTML = message;

        setTimeout(function(){

            
            success.classList= "alert alert-success d-none";
            $("#categoryForm")[0].reset();

        },3000);
    }
    else{
        error.classList ="alert alert-danger";
        error.innerHTML = message;
    }
}


$("#categoryTable").on("click","a.update_info", function(){
    let id = $(this).attr("update_id");
    $("#categoryModal").modal("show");
    fetch_category_info(id);
});

$("#categoryTable").on("click","a.delete_info", function(){
    let id = $(this).attr("delete_id");
    if(confirm("Are you sure to delete this user?")){
        delete_category(id);
    }
});