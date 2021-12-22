$(document).ready(function() {
    const customerId = $('#customerId').val();
    console.log(customerId);
        // Get all from albums for dropdown
    $.ajax({
        type:"GET",
        url: "https://sharifs-music-api.herokuapp.com/api/invoice?customerid="+customerId,
        success: function(data){
            console.log(data.invoice);
            $.each(data.invoice, function (key, value) {
                $("#invoiceDrop").append($("<option>", {value: value.InvoiceId, text: value.InvoiceId}));
            })

        }
    });
    
    $(document).delegate('#showInvoice', 'click', function(event) {
        event.preventDefault();
        
        const id = $('#invoiceDrop').val();
        
        $.ajax({
            type: "GET",
            url: 'https://sharifs-music-api.herokuapp.com/api/invoice/'+id,
            success: function(result) {
                console.log(result.invoice.Tracks[0].TrackId)

                var count=1;
                var output = '';
                $("div#showResults").empty();
                output +=
                        `<p> <strong>Invoice Id:</strong> ${result.invoice.InvoiceId}</p>
                        <p> <strong>Invoice Date:</strong> ${result.invoice.InvoiceDate}</p>`;
                $.each(result.invoice.Tracks, function (key, value) {
                    output +=
                        `<p> <strong>Track:</strong> ${count}</p>
                        <p> <strong>Track Name:</strong> ${value.TrackName} <strong> --- Unit Price:</strong> ${value.UnitPrice}<strong> --- Quantity:</strong> ${value.Quantity}</p>`;
                    count=count+1;
                });
                output +=
                    `<p> <strong>Billing Address:</strong> ${result.invoice.BillingAddress}</p>
                    <p> <strong>Billing City:</strong> ${result.invoice.BillingCity}</p>
                    <p> <strong>Billing State:</strong> ${result.invoice.BillingState}</p>
                    <p> <strong>Billing Country:</strong> ${result.invoice.BillingCountry}</p>
                    <p> <strong>Billing Postal Code:</strong> ${result.invoice.BillingPostalCode}</p>
                    <p> <strong>Total:</strong> ${result.invoice.Total}</p>`;
                const trackOut = $("<div />", {});
                trackOut.append(output);
                trackOut.appendTo($("#showResults"));
                console.log(output);

            },
            error: function(err) {
                alert(err);
                console.log("Error")
            }
        });
    });

});