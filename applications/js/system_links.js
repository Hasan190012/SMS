load_links();
fill_links();
fill_category();
btnAction = "Insert";

$("#addLink").on("click", function(){

    $("#linkModal").modal("show");

});


$("#linkForm").on("submit", function(event) {
    event.preventDefault();

    let name = $("#name").val();
    let link = $("#link_id").val();
    let category_id = $("#category").val();
    let id = $("#id").val();

    let sendingData = {}
    

    if(btnAction == "Insert"){


        sendingData = {
            "id" : id,
            "name" : name,
            "link" : link,
            "category_id" : category_id,
            "action" : "register_link"
        }
    }else{

        sendingData = {
    
            "id"  : id,
            "name" : name,
            "link" : link,
            "category_id" : category_id,
            "action" : "update_link"
        }

    }

    $.ajax ( { 
        method : "POST",
        dataType : "JSON",
        url : "../api/system_links.php",
        data: sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if(status){
                Allerts("success", response);
                btnAction = "Insert";
                $("#linkTable tbody").empty();
                load_links();
            }else{
                Allerts("error", response);
            }
        },
        error: function(data){
            Allerts("error", data.responseText);
        }
    });

});


function fetch_link_info(id){
    let sendingData = {
        "action" : "fetch_link_info",
        "id" : id
    }

    $.ajax( { 
        method : "POST",
        dataType : "JSON",
        url : "../api/system_links.php",
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
                $("#link_id").val(response['link']);
                $("#category").val(response['category_id']);
                $("#linkModal").modal("show");
            }else{
                Allerts("error", response)
            }
        },
        error: function(data){
            Allerts("error", response);
        }
    })
}

function delete_link(id){
    let sendingData = {
        "action" : "delete_link",
        "id" : id
    }

    $.ajax ({ 
        method : "POST",
        dataType: "JSON",
        url : "../api/system_links.php",
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
                    $("#linkTable tbody").empty();
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

function load_links(){
    let sendingData = {
        "action" : "load_system_db_links"
    }

    $.ajax({ 
        method : "POST",
        dataType : "JSON",
        url : "../api/system_links.php",
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

                $("#linkTable tbody").append(tr);
            }else{
                Allerts("error", response);
            }
        },
        error: function(data){
            Allerts("error", data.responseText);
        }
    })
}

function fill_links(){

    let sendingData ={
    "action" : "read_all_system_links"

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
                    html += `<option value="${res}">${res}</option>`;
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

function fill_category(){

    let sendingData ={
    "action" : "load_category"

}

    $.ajax( {

        method: "POST",
        dataType: "JSON",
        url: "../api/category.php",
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

                $("#category").append(html);

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
            $("#linkForm")[0].reset();

        },3000);
    }
    else{
        error.classList ="alert alert-danger";
        error.innerHTML = message;
    }
}

$("#linkTable").on("click","a.update_info", function(){
    let id = $(this).attr("update_id");
    $("#linkModal").modal("show");
    fetch_link_info(id);
});


$("#linkTable").on("click","a.delete_info", function(){
    let id = $(this).attr("delete_id");
    if(confirm("Are you sure to delete this user?")){
        delete_link(id);
    }
});
