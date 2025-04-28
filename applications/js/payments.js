load_Payments();
btnAction = "Insert";

$("#addPayment").on("click", function(){

    $("#staticBackdrop").modal("show");

});


$("#paymentForm").on("submit", function(event) {
    event.preventDefault();

    let studentId = $("#student_ID").val();
    let feeType = $("#fee_Type").val();
    let amountPaid = $("#amount_Paid").val();
    let paymentStatus = $("#payments").val();
    let id = $("#paymentId").val();

    let sendingData = {}

    if(btnAction == "Insert"){


        sendingData = {

            "id" : studentId,
            "feeType" : feeType,
            "amountPaid" : amountPaid,
            "paymentStatus" : paymentStatus,
            "action" : "register_payment"
        }
    }else{

        sendingData = {
            "paymentId" : paymentId,
            "id"  : id,
            "feeType" : feeType,
            "amountPaid" : amountPaid,
            "paymentStatus" : paymentStatus,
            "action" : "update_payment"
        }

    }

    $.ajax ( { 
        method : "POST",
        dataType : "JSON",
        url : "../api/payment.php",
        data: sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if(status){
                allerts("success", response);
                btnAction = "Insert";
                $("#paymentTable tbody").empty();
                load_Payments();
            }else{
                allerts("error", response);
            }
        },
        error: function(data){
            allerts("error", data.responseText);
        }
    });

});




function load_Payments(){
    
    let sendingData = {
        "action" : "load_payments"
    }

    $.ajax( {
        method : "POST",
        dataType: "JSON",
        url : "../api/payment.php",
        data : sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if(status){
                response.forEach(res => {
                    tr += "<tr>";

                    for(let r in res){
                        if(r == "paymentStatus"){
                            if(res[r] == "paid"){
                                tr +=`<td><span  class="badge text-bg-success">${res[r]}</span></td>`;
                            }else{
                                tr +=`<td><span  class="badge text-bg-info">${res[r]}</span></td>`;
                            }
                        }else{
                            // tr += `<td>${res[r]}</td>`;

                            if(r == "amountPaid"){
                                tr += `<td>$${res[r]}</td>`;
                                
                            }else if(r == "BlanceRemain"){
                                tr += `<td>$${res[r]}</td>`;
                            }else{
                                tr += `<td>${res[r]}</td>`;
                            }
                        }
                    }

                    tr +=`<td><a  class="btn btn-info update_info btn-sm" update_id=${res['paymentId']}><i class="bi bi-pencil-square" style="color: #fff;"></i></a>
                    <a  class="btn btn-danger delete_info btn-sm" delete_id=${res['paymentId']}><i class="bi bi-trash-fill" style="color: #fff;"></td>`;

                    tr += "</tr>";
                })
                $("#paymentTable tbody").append(tr);

            }else{
                allerts("error", response);
            }
        },
        error: function(data){
            allerts("error", data);
        }


    });
}

function fetch_data(paymentId){
    let sendingData = {
        "action" : "fecth_payment_Data",
        "paymentId" : paymentId
    }

    $.ajax ({
        method : "POST",
        dataType : "JSON",
        url : "../api/payment.php",
        data : sendingData,
        success: function(data){
            let status = data.status;
            let response = data.data;
            let html = '';
            let tr = '';

            if(status){

                btnAction = "Update";
                $("#paymentId").val(response['paymentId']);
                $("#student_ID").val(response['id']);
                $("#fee_Type").val(response['feeType']);
                $("#amount_Paid").val(response['amountPaid']);
                $("#payments").val(response['paymentStatus']);
                $("#staticBackdrop").modal('show');
            }

        },
        error: function(data){
            allerts("error", data);
        }
    })
}

function delete_payment(paymentId){
    let sendingData = {
        "action" : "delete_payment",
        "paymentId" : paymentId
    }

    $.ajax ({ 
        method : "POST",
        dataType: "JSON",
        url : "../api/payment.php",
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
                    $("#paymentTable tbody").empty();
                    load_Payments();
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




function allerts(type, message){
    let success = document.querySelector(".alert-success");
    let error = document.querySelector(".alert-danger");

    if(type == "success"){
        error.classList = "alert alert-success  d-none";
        success.classList = "alert alert-success";
        success.innerHTML = message;


        setTimeout(function(){
            success.classList = "alert alert-success  d-none"
            $("#paymentForm")[0].reset();
        },3000)
    }else{
       error.classList = "alert alert-danger";
       error.innerHTML = message;
    }
}


$("#paymentTable").on("click","a.update_info", function(){
    let id = $(this).attr('update_id');
    $("#staticBackdrop").modal('show');
    fetch_data(id);

})

$("#paymentTable").on("click","a.delete_info", function(){
    let id = $(this).attr("delete_id");

    if(confirm("are you sure to delete this payment")){
        delete_payment(id);
    }

})


