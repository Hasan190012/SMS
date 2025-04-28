load_actions();
fill_links();
btnAction = "Insert";
$("#addAction").on("click", function(){

    $("#actionModal").modal("show");

});


$("#actionForm").on("submit", function(event) {
    event.preventDefault();

    let name = $("#name").val();
    let system_action = $("#system_action").val();
    let link_id = $("#link_id").val();
    let id = $("#id").val();

    let sendingData = {}
    

    if(btnAction == "Insert"){


        sendingData = {
            "name" : name,
            "system_action" : system_action,
            "link_id" : link_id,
            "action" : "register_action"
        }
    }else{

        sendingData = {
    
            "id"  : id,
            "name" : name,
            "system_action" : system_action,
            "link_id" : link_id,
            "action" : "update_actions"
        }

    }

    $.ajax ( { 
        method : "POST",
        dataType : "JSON",
        url : "../api/system_actions.php",
        data: sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if(status){
                Allerts("success", response);
                btnAction = "Insert";
                $("#actionTable tbody").empty();
                load_actions();
            }else{
                Allerts("error", response);
            }
        },
        error: function(data){
            Allerts("error", data.responseText);
        }
    });

});

function load_actions(){
    let sendingData = {
        "action" : "load_actions"
    }

    $.ajax({ 
        method : "POST",
        dataType : "JSON",
        url : "../api/system_actions.php",
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

                        
                            tr += `<td>${res[r]}</td>`;
                    
                    }

                    tr +=`<td><a  class="btn btn-info update_info btn-sm" update_id=${res['id']}><i class="bi bi-pencil-square" style="color: #fff;"></i></a>
                    <a  class="btn btn-danger delete_info btn-sm" delete_id=${res['id']}><i class="bi bi-trash-fill" style="color: #fff;"></td>`;

                    tr += "</tr>";
                })

                $("#actionTable tbody").append(tr);
            }else{
                Allerts("error", response);
            }
        },
        error: function(data){
            Allerts("error", data.responseText);
        }
    })
}

function delete_link(id){
    let sendingData = {
        "action" : "delete_actions",
        "id" : id
    }

    $.ajax ({ 
        method : "POST",
        dataType: "JSON",
        url : "../api/system_actions.php",
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
                    $("#actionTable tbody").empty();
                    load_links();
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

function fetch_action_info(id){
    let sendingData = {
        "action" : "fetch_actions",
        "id" : id
    }

    $.ajax( { 
        method : "POST",
        dataType : "JSON",
        url : "../api/system_actions.php",
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
                $("#system_action").val(response['ac']);
                $("#link_id").val(response['link_id']);
                $("#actionModal").modal("show");
            }else{
                Allerts("error", response)
            }
        },
        error: function(data){
            Allerts("error", response);
        }
    })
}

function fill_links(){

    let sendingData ={
    "action" : "load_system_db_links"

}

    $.ajax( {

        method: "POST",
        dataType: "JSON",
        url: "../api/system_links.php",
        data: sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr ='';

            if(status){
                response.forEach( res => {
                    html += `<option value="${res['id']}">${res['name']}</option>`;
                })

                $("#link_id").append(html);

            }else{
                Allerts("error",response);
            }
        },
        error: function(data){
            Allerts("error", data);
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
            $("#actionForm")[0].reset();

        },3000);
    }
    else{
        error.classList ="alert alert-danger";
        error.innerHTML = message;
    }
}

$("#actionTable").on("click",".update_info", function(){
    let id = $(this).attr("update_id");
    $("#actionModal").modal("show");
    fetch_action_info(id);
})

$("#actionTable").on("click",".delete_info", function(){
    let id = $(this).attr("delete_id");
   if(confirm("are sure to delete this action?")){
    delete_link(id);
   }
   
})