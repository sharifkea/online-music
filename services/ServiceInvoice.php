<?php 
require_once __DIR__.'/db.php';
require_once __DIR__.'/ServiceInvoiceLine.php';

class InvoiceService 
{
    function isDataValid() 
        {
            if (isset($_POST['customerId']) && !empty($_POST['customerId']) && isset($_POST['invoiceDate']) && 
            !empty($_POST['invoiceDate']) && isset($_POST['total']) && !empty($_POST['total'])) 
            {
                return true;
            } else {
                return false;
            }
        }
        
    function InsertInvoice($customerId, $invoiceDate, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $total) 
    {
        $connection = Connect::GetConnection();
        $sql = "INSERT INTO `invoice` (`CustomerId`, `InvoiceDate`, `BillingAddress`, `BillingCity`, `BillingState`, `BillingCountry`, `BillingPostalcode`, `Total`) VALUES(:customerId, :invoiceDate, :billingAddress, :billingCity, :billingState, :billingCountry, :billingPostalCode, :total)";
        $stmt = $connection->prepare($sql);

        if ($stmt->execute([':customerId'=> $customerId, ':invoiceDate'=> $invoiceDate, ':billingAddress'=> $billingAddress,
                ':billingCity'=> $billingCity, ':billingState'=> $billingState, ':billingCountry'=> $billingCountry, 
                ':billingPostalCode' => $billingPostalCode, ':total' => $total])) 
            {
                return true;
            } else {
                return false;
            }
    }

    function Insert($customerId
                            , $billingAddress, $billingCity, $billingState, $billingCountry
                            , $billingPostalCode,$items) 
    {
        $invoiceDate= date("Y-m-d H:i:s");
        $total=0;
        foreach($items as $val) {
          $total+=$val['value']['total'];
        }

        $connection = Connect::GetConnection();
        $sql = "INSERT INTO `invoice` (`CustomerId`, `InvoiceDate`, `BillingAddress`, `BillingCity`, `BillingState`, `BillingCountry`, `BillingPostalcode`, `Total`) VALUES(:customerId, :invoiceDate, :billingAddress, :billingCity, :billingState, :billingCountry, :billingPostalCode, :total)";
        $stmt = $connection->prepare($sql);
        
        if ($stmt->execute([':customerId'=> $customerId, ':invoiceDate'=> $invoiceDate, ':billingAddress'=> $billingAddress,
                ':billingCity'=> $billingCity, ':billingState'=> $billingState, ':billingCountry'=> $billingCountry, 
                ':billingPostalCode' => $billingPostalCode, ':total' => $total])) 
            {
             
           
                  $stmt = $connection->query("SELECT LAST_INSERT_ID()");
                  $result = $stmt->fetch(PDO::FETCH_ASSOC);
                  $lastID  = $result['LAST_INSERT_ID()'];
                  //print_r($result);
                  $service = new InvoiceLineService; 
                  foreach($items as $val) {
                  
                    //$total+=$val['value']['total'];
                    //$invoiceId, $trackId, $unitPrice, $quantity
                    $service->InsertInvoiveLine($lastID,$val['ID'], $val['value']['unitPrice'],$val['value']['qty']);
                  }
                
                return $lastID;
            } else {
                return 0;
            }
    }


    function GetInvoices($pageNo) {
        $connection = Connect::GetConnection();
        $limit = 20;
    
        $start = ($pageNo-1) * $limit;
    
        // query to get Invoice from invoice table
        $sql = "SELECT * FROM invoice LIMIT $start, $limit";
    
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $invoice = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $invoice;
    }

    function GetTotalInvoicesCount($limit){
        $connection = Connect::GetConnection();
        $count_query = "SELECT * FROM invoice";
        $query = $connection->prepare($count_query);
        $query->execute();
        $total_result = $query->rowCount();

        // calculate the total pages
        $total_pages = ceil($total_result/$limit);
        return $total_pages;
    }

    function GetInvoicesApi($pageNo)
    {
      header('Content-Type: application/json');
      echo json_encode($this->GetInvoices($pageNo));
    }

    function GetInvoiceById($id) {
        $connection = Connect::GetConnection();    
        $sql ='SELECT * FROM invoice WHERE InvoiceId = :id';
        $stmt = $connection->prepare($sql);
        $stmt->execute([':id' => $id]);
        $invoice = $stmt->fetch(PDO::FETCH_OBJ);
        return $invoice;
    }

    function UpdateInvoice($id, $customerId, $invoiceDate, $billingAddress, $billingCity, $billingState, $billingCountry, $billingPostalCode, $total) {
        $connection = Connect::GetConnection();                
    
        $sql = "UPDATE `invoice` SET `CustomerId`= :customerId,`InvoiceDate`= :invoiceDate,`BillingAddress`= :billingAddress,`BillingCity`= :billingCity,`BillingState`= :billingState,`BillingCountry`= :billingCountry,`BillingPostalCode`= :billingPostalCode,`Total`= :total WHERE InvoiceId = :id";
    
        $stmt = $connection->prepare($sql);
        if ($stmt->execute([':customerId'=> $customerId, ':invoiceDate'=> $invoiceDate, ':billingAddress'=> $billingAddress,
            ':billingCity'=> $billingCity, ':billingState'=> $billingState, ':billingCountry'=> $billingCountry, ':billingPostalCode'=> $billingPostalCode, 
            ':total'=> $total, ':id' => $id])) {
                return true;
            }
            return false;
    }

    function DeleteInvoice($id) {
        $connection = Connect::GetConnection();
        $sql = 'DELETE FROM invoice WHERE InvoiceId = :id';
        $stmt = $connection->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>