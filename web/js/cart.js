function qtchange() {  
 $(".qtchange").click(function(){
   let curinput = parseInt($(this).parent().find($('input[type=number]')).val());
   if ($(this).hasClass("qtdown")) $(this).parent().find($('input[type=number]')).val((curinput - 1));
   if ($(this).hasClass("qtup")) $(this).parent().find($('input[type=number]')).val((curinput + 1));

    let el, id, qt, i;
    let pid = [];
    let pqt = [];
    $(".card .quantity").each(function(){
      el = $(this);
      id = el.data('id');
      qt = el.val();
      i = el.data('number');
      pid[i] = id;
      pqt[i] = qt;
    })
    pid = JSON.stringify(pid);
    pqt = JSON.stringify(pqt);
    $.ajax({url: "/site/cartaction", type: 'POST',  // http method
      data: { id: pid, qt: pqt }, success: function(result){
      $("main .container").html(result);
      qtchange();
    }});
  });
}
$( document ).ready(function() {
    qtchange();
});



// Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                let total = $("#total").html();
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: total
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    // Replace the above to show a success message within this page, e.g.
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                    actions.redirect('https://strode-college-bgvlado302759.codeanyapp.com/site/checkout');
                });
            }


        }).render('#paypal-button-container');