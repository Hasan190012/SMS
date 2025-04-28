
load_authorities();

function load_authorities(){
    let sendingData = {
        "action" : "read_system_permissons"
    }

    $.ajax({
        method : "POST",
        dataType : "JSON",
        url : "../api/user_authority.php",
        data : sendingData,
        success : function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let role = '';
            let system_links = '';
            let system_actions = '';

            if(status){
                response.forEach(res => {

                    for(let r in res){

                        if(res['role'] !== role){
                            html += `
                            </fieldset>
                            </div></div>

                            <div class="col-sm-4">
                            <fieldset class="authority_border">
                                <legend class="authority_border">
                                    <input style="margin: 10px;" 
                                    type="checkbox" 
                                    name="role_authority[]" 
                                    id="" value="${res['role']}">


                                    ${res['role']}

                                    </legend>
                            
                            `;

                            role = res['role'];
                        }

                        if(res['name'] !== system_links){
                            html += `
                            
                            <div class="control-group">
                            <label class="control-label input-label" >

                            <input type="checkbox" 
                            name="system_link[]" 
                            style="margin-left: 40px !important;
                            font-size: 25px !important;" 
                            role="${res['role']}" id="" value="${res['name']}" category_id="${res['category_id']}" link_id="${res['link_id']}">
                            ${res['name']}

                            </labe>
                            
                            `;
                            system_links = res['name'];

                        }

                        if(res['action_name'] !== system_actions){

                            html += `

                            <div class="system_action">
                            <label class="control-label input-label">
                            <input type="checkbox" 
                            name="system_action[]"
                            style="margin-left: 65px !important;
                            font-size: 25px !important;
                            margin-top: 10px !important;"
                            role="${res['role']}" id="" value="${res['action_id']}" category_id="${res['category_id']}" link_id="${res['link_id']}" action_id="${res['action_id']}">
                            ${res['action_name']}

                            </label>
                            </div>
                            
                            `;

                            system_actions = res['action_name'];
                        }

                    }

                })

                $("#authority_area").append(html);


            }else{
                // Allerts("error", response);
            }
        },
        error: function(data){
        //    Allerts("error", data);
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