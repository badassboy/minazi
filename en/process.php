<?php include_once 'inc/functions.php';
include_once 'inc/carter.php';
include_once 'curl/Curl.php';

$custid = $_SESSION['mz-cust-id'];
$orderid = $_SESSION['order_id'];


function get_deliv(){
    global $zp;
    $my_id = $_SESSION['mz-cust-id'];
    $zp->where('c_email',$my_id);
    $tag = $zp->getOne(customers);
    if($tag['c_state'] == '1-2'){
        return '25.00';
    }else{
        return deliv_fee();
    }
}

if(isset($_POST['process-pay'])){
    $amount = $_POST['amount'];
    $tr = $_SESSION['tx_ref'];
    $_SESSION['cust-name'] = $_POST['c_fname'].' '.$_POST['c_lname'];
    $_SESSION['cust-add1'] = $_POST['c_address'];
    $_SESSION['cust-add2'] = $_POST['c_address2'];

    $name = $_POST['c_fname'].' '.$_POST['c_lname'];
    $email = $_POST['c_email'];
    $phone = $_POST['c_phone'];
    $payments = $_POST['payments'];

    if($payments == 'flutter'){
        $curl = new Curl();
        $curl->setHeader('Authorization', sec_key);
        $curl->setHeader('Content-Type', 'application/json');
        $curl->post('https://api.flutterwave.com/v3/payments', [
            "tx_ref"=> $tr,
            "amount"=> $amount,
            "currency"=> "AED",
            //"payment_options"=> "mobilemoneyghana",
            "redirect_url"=> base."process.php",
            "customer"=> [
                "name"=> $name,
                "email"=> $email,
                "phonenumber"=> $phone,
            ],
            "customizations"=> [
                "title"=> "Minazi.Store",
                "description"=> "me@minazi.store",
                "logo"=> "https://minazi.store/en/assets/img/minazi.jpg",
            ]
        ]);

        if ($curl->error) {
            echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
        } else {
            // echo 'Response:' . "\n";
            // print_r($curl->response);
            $response = $curl->response;
            header('Location: '.$response->data->link);
        }
    }elseif($payments == 'delivery'){
        $amount = $_SESSION['newest_p'];
        $txid = 'pay-on-deliv';
            //Insert in Payment Table
            $pack = array(
                'c_id' => getCtU($custid,'c_id'),
                'order_id' => $orderid,
                'tx_ref' => 'pay-on-deliv',
                'pay_type' => 'Pay-On-Delivery',
                'order_add' =>  $_SESSION['cust-name'].',<br>'. $_SESSION['cust-add1'].',<br>'. $_SESSION['cust-add2'],
                'paid_amount' => $amount,
                'address' => getCtU($custid,'c_phone').'<br>'.getCtU($custid,'c_address').'<br>'.getCtU($custid,'c_address2').', '.getCtU($custid,'c_city').', '.$state[getCtU($custid,'c_state')],
                'payment_status' => 'pending',
                'shipping_status' => 'pending'
            );
            $zp->insert(payments, $pack);
            foreach($cart->getItems() as $new){
                $back = array(
                    'order_id' => $orderid,
                    'p_id' => $new[0]['id'],
                    'quantity' => $new[0]['quantity'],
                    'unit_price' => $new[0]['attributes']['price'],
                );
                $zp->insert(orders, $back);
            }
            $_SESSION['mz_invoice'] = array(
                'id' => $orderid,
                'date' => date('Y-m-d'),
                'delivery' => deliv(),
                'sub_total' => $_SESSION['sub_t'],
                'total' => $_SESSION['newest_p'],
                'items' => $cart->getItems()
            );

            $to = $custid; 
            $fromName = 'MINAZI.STORE'; 
            
            $subject = "Transaction Reciept"; 
            
            $htmlContent = ' 
            <html lang="en">
                <head>
                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1" />

                    <title>Reciept from MINAZI.STORE</title>

                    <!-- Favicon -->
                    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

                    <!-- Invoice styling -->
                    <style>
                        body {
                            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                            text-align: center;
                            color: #777;
                        }

                        body h1 {
                            font-weight: 300;
                            margin-bottom: 0px;
                            padding-bottom: 0px;
                            color: #000;
                        }

                        body h3 {
                            font-weight: 300;
                            margin-top: 10px;
                            margin-bottom: 20px;
                            font-style: italic;
                            color: #555;
                        }

                        body a {
                            color: #06f;
                        }

                        .invoice-box {
                            max-width: 800px;
                            margin: auto;
                            padding: 30px;
                            border: 1px solid #eee;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                            font-size: 16px;
                            line-height: 24px;
                            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                            color: #555;
                        }

                        .invoice-box table {
                            width: 100%;
                            line-height: inherit;
                            text-align: left;
                            border-collapse: collapse;
                        }

                        .invoice-box table td {
                            padding: 5px;
                            vertical-align: top;
                        }

                        .invoice-box table tr td:nth-child(2) {
                            text-align: right;
                        }

                        .invoice-box table tr.top table td {
                            padding-bottom: 20px;
                        }

                        .invoice-box table tr.top table td.title {
                            font-size: 45px;
                            line-height: 45px;
                            color: #333;
                        }

                        .invoice-box table tr.information table td {
                            padding-bottom: 40px;
                        }

                        .invoice-box table tr.heading td {
                            background: #eee;
                            border-bottom: 1px solid #ddd;
                            font-weight: bold;
                        }

                        .invoice-box table tr.details td {
                            padding-bottom: 20px;
                        }

                        .invoice-box table tr.item td {
                            border-bottom: 1px solid #eee;
                        }

                        .invoice-box table tr.item.last td {
                            border-bottom: none;
                        }

                        .invoice-box table tr.total td:nth-child(2) {
                            border-top: 2px solid #eee;
                            font-weight: bold;
                        }

                        @media only screen and (max-width: 600px) {
                            .invoice-box table tr.top table td {
                                width: 100%;
                                display: block;
                                text-align: center;
                            }

                            .invoice-box table tr.information table td {
                                width: 100%;
                                display: block;
                                text-align: center;
                            }
                        }
                    </style>
                </head>

                <body>
                    <h1>Transaction on '.date('d-m-Y').'</h1>
                    Meant for '.$custid.'<br />

                    <div class="invoice-box">
                        <table>
                            <tr class="top">
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="title">
                                                <img src="https://minazi.store/en/assets/img/minazi.png" alt="minazi.store" style="width: 100%; max-width: 300px" />
                                            </td>

                                            <td>
                                                Invoice #: '.$orderid.'<br />
                                                Created: '.date('jS F, Y').'
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="information">
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td>
                                                support@minazi.store,<br />
                                                +971521398226,<br />
                                                +233554660985
                                            </td>

                                            <td>
                                            '.getCtU($custid,'c_fname').' '.getCtU($custid,'c_lname').'<br>'.getCtU($custid,'c_phone').'<br>'.getCtU($custid,'c_address').'<br>'.getCtU($custid,'c_address2').', '.getCtU($custid,'c_city').', '.$state[getCtU($custid,'c_state')].'
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="heading">
                                <td>Payment Method</td>

                                <td>Status</td>
                            </tr>

                            <tr class="details">
                                <td>Pay-On-Delivery</td>

                                <td>Pending</td>
                            </tr>

                            <tr class="heading">
                                <td>Item</td>

                                <td>Price</td>
                            </tr>

                            <tr class="item last">
                                <td>Food and Herbal Stuffs </td>

                                <td>'.curcy().number_format($cart->getAttributeTotal('price'), 2, '.', ',').'</td>
                            </tr>

                            <tr class="item last">
                                <td>Delivery Fee </td>

                                <td>'.curcy().number_format(get_deliv(), 2, '.', ',').'</td>
                            </tr>

                            <tr class="total">
                                <td><b>Total:</b></td>

                                <td><b>'.curcy().number_format($cart->getAttributeTotal('price') + get_deliv(), 2, '.', ',').'</b></td>
                            </tr>
                        </table>
                    </div>
                </body>
            </html>'; 

            $to2 = 'minazifoodstuff@gmail.com'; 
            $fromName2 = 'MINAZI.STORE'; 
            
            $subject2 = "Pending Order"; 
            
            $htmlContent2 = ' 
            <html lang="en">
                <head>
                    <meta charset="utf-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1" />

                    <title>Pending Order</title>

                    <!-- Favicon -->
                    <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

                    <!-- Invoice styling -->
                    <style>
                        body {
                            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                            text-align: center;
                            color: #777;
                        }

                        body h1 {
                            font-weight: 300;
                            margin-bottom: 0px;
                            padding-bottom: 0px;
                            color: #000;
                        }

                        body h3 {
                            font-weight: 300;
                            margin-top: 10px;
                            margin-bottom: 20px;
                            font-style: italic;
                            color: #555;
                        }

                        body a {
                            color: #06f;
                        }

                        .invoice-box {
                            max-width: 800px;
                            margin: auto;
                            padding: 30px;
                            border: 1px solid #eee;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                            font-size: 16px;
                            line-height: 24px;
                            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                            color: #555;
                        }

                        .invoice-box table {
                            width: 100%;
                            line-height: inherit;
                            text-align: left;
                            border-collapse: collapse;
                        }

                        .invoice-box table td {
                            padding: 5px;
                            vertical-align: top;
                        }

                        .invoice-box table tr td:nth-child(2) {
                            text-align: right;
                        }

                        .invoice-box table tr.top table td {
                            padding-bottom: 20px;
                        }

                        .invoice-box table tr.top table td.title {
                            font-size: 45px;
                            line-height: 45px;
                            color: #333;
                        }

                        .invoice-box table tr.information table td {
                            padding-bottom: 40px;
                        }

                        .invoice-box table tr.heading td {
                            background: #eee;
                            border-bottom: 1px solid #ddd;
                            font-weight: bold;
                        }

                        .invoice-box table tr.details td {
                            padding-bottom: 20px;
                        }

                        .invoice-box table tr.item td {
                            border-bottom: 1px solid #eee;
                        }

                        .invoice-box table tr.item.last td {
                            border-bottom: none;
                        }

                        .invoice-box table tr.total td:nth-child(2) {
                            border-top: 2px solid #eee;
                            font-weight: bold;
                        }

                        @media only screen and (max-width: 600px) {
                            .invoice-box table tr.top table td {
                                width: 100%;
                                display: block;
                                text-align: center;
                            }

                            .invoice-box table tr.information table td {
                                width: 100%;
                                display: block;
                                text-align: center;
                            }
                        }
                    </style>
                </head>

                <body>
                    <h1>Transaction on '.date('d-m-Y').'</h1>

                    <div class="invoice-box">
                        <table>
                            <tr class="top">
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td class="title">
                                                <img src="https://minazi.store/en/assets/img/minazi.png" alt="minazi.store" style="width: 100%; max-width: 300px" />
                                            </td>

                                            <td>
                                                Invoice #: '.$orderid.'<br />
                                                Created: '.date('jS F, Y').'
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="information">
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td>
                                                support@minazi.store,<br />
                                                +971521398226,<br />
                                                +233554660985
                                            </td>

                                            <td>
                                                '.getCtU($custid,'c_fname').' '.getCtU($custid,'c_lname').'<br>'.getCtU($custid,'c_phone').'<br>'.getCtU($custid,'c_address').'<br>'.getCtU($custid,'c_address2').', '.getCtU($custid,'c_city').', '.$state[getCtU($custid,'c_state')].'
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="heading">
                                <td>Payment Method</td>

                                <td>Status</td>
                            </tr>

                            <tr class="details">
                                <td>Pay-On-Delivery</td>

                                <td>Pending</td>
                            </tr>

                            <tr class="heading">
                                <td>Item</td>

                                <td>Price</td>
                            </tr>

                            <tr class="item last">
                                <td>Food and Herbal Stuffs </td>

                                <td>'.curcy().number_format($cart->getAttributeTotal('price'), 2, '.', ',').'</td>
                            </tr>

                            <tr class="item last">
                                <td>Delivery Fee </td>

                                <td>'.curcy().number_format(get_deliv(), 2, '.', ',').'</td>
                            </tr>

                            <tr class="total">
                                <td><b>Total:</b></td>

                                <td><b>'.curcy().number_format($cart->getAttributeTotal('price') + get_deliv(), 2, '.', ',').'</b></td>
                            </tr>
                        </table>
                    </div>
                </body>
            </html>'; 
            
            // Set content-type header for sending HTML email 
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            mail($to, $subject, $htmlContent, $headers);
            mail($to2, $subject2, $htmlContent2, $headers);

            unset($_SESSION['tx_ref']);
            unset($_SESSION['order_id']);
            unset($_SESSION['newest_p']);
            unset($_SESSION['cust-name']);
            unset($_SESSION['cust-add1']);
            unset($_SESSION['cust-add2']);
            $_SESSION['sess-ready'] = false;
            $cart->clear();

            //Head to Completion of Order
            header('Location: invoice.php');
    }
    //exit;
}

if(isset($_GET['status']) && isset($_GET['tx_ref'])){
    $status = $_GET['status'];
    $txref = $_GET['tx_ref'];
    $amount = $_SESSION['newest_p'];
    //Return To Checkout if Cancelled by User
    if($status == 'cancelled'){
        $_SESSION['pay_msg'] = 'Payment was Cancelled!';
        header('Location: checkout.php');
    }elseif($status == 'successful'){
        $txid = $_GET['transaction_id'];
        //Insert in Payment Table
        $pack = array(
            'c_id' => getCtU($custid,'c_id'),
            'order_id' => $orderid,
            'tx_ref' => $txref,
            'pay_type' => 'FlutterWave',
            'order_add' =>  $_SESSION['cust-name'].',<br>'. $_SESSION['cust-add1'].',<br>'. $_SESSION['cust-add2'],
            'paid_amount' => $amount,
            'trans_id' => $txid,
            'payment_status' => 'paid',
            'shipping_status' => 'pending'
        );
        $zp->insert(payments, $pack);
        foreach($cart->getItems() as $new){
            $back = array(
                'order_id' => $orderid,
                'p_id' => $new[0]['id'],
                'quantity' => $new[0]['quantity'],
                'unit_price' => $new[0]['attributes']['price'],
            );
            $zp->insert(orders, $back);
        }
        $_SESSION['mz_invoice'] = array(
            'id' => $orderid,
            'date' => date('Y-m-d'),
            'delivery' => deliv(),
            'sub_total' => $_SESSION['sub_t'],
            'total' => $_SESSION['newest_p'],
            'items' => $cart->getItems()
        );

        $to = $custid; 
        $fromName = 'MINAZI.STORE'; 
        
        $subject = "Transaction Reciept"; 
        
        $htmlContent = ' 
        <html lang="en">
            <head>
                <meta charset="utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />

                <title>Reciept from MINAZI.STORE</title>

                <!-- Favicon -->
                <link rel="icon" href="./images/favicon.png" type="image/x-icon" />

                <!-- Invoice styling -->
                <style>
                    body {
                        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                        text-align: center;
                        color: #777;
                    }

                    body h1 {
                        font-weight: 300;
                        margin-bottom: 0px;
                        padding-bottom: 0px;
                        color: #000;
                    }

                    body h3 {
                        font-weight: 300;
                        margin-top: 10px;
                        margin-bottom: 20px;
                        font-style: italic;
                        color: #555;
                    }

                    body a {
                        color: #06f;
                    }

                    .invoice-box {
                        max-width: 800px;
                        margin: auto;
                        padding: 30px;
                        border: 1px solid #eee;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                        font-size: 16px;
                        line-height: 24px;
                        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                        color: #555;
                    }

                    .invoice-box table {
                        width: 100%;
                        line-height: inherit;
                        text-align: left;
                        border-collapse: collapse;
                    }

                    .invoice-box table td {
                        padding: 5px;
                        vertical-align: top;
                    }

                    .invoice-box table tr td:nth-child(2) {
                        text-align: right;
                    }

                    .invoice-box table tr.top table td {
                        padding-bottom: 20px;
                    }

                    .invoice-box table tr.top table td.title {
                        font-size: 45px;
                        line-height: 45px;
                        color: #333;
                    }

                    .invoice-box table tr.information table td {
                        padding-bottom: 40px;
                    }

                    .invoice-box table tr.heading td {
                        background: #eee;
                        border-bottom: 1px solid #ddd;
                        font-weight: bold;
                    }

                    .invoice-box table tr.details td {
                        padding-bottom: 20px;
                    }

                    .invoice-box table tr.item td {
                        border-bottom: 1px solid #eee;
                    }

                    .invoice-box table tr.item.last td {
                        border-bottom: none;
                    }

                    .invoice-box table tr.total td:nth-child(2) {
                        border-top: 2px solid #eee;
                        font-weight: bold;
                    }

                    @media only screen and (max-width: 600px) {
                        .invoice-box table tr.top table td {
                            width: 100%;
                            display: block;
                            text-align: center;
                        }

                        .invoice-box table tr.information table td {
                            width: 100%;
                            display: block;
                            text-align: center;
                        }
                    }
                </style>
            </head>

            <body>
                <h1>Transaction on '.date('d-m-Y').'</h1>
                Meant for '.$custid.'<br />

                <div class="invoice-box">
                    <table>
                        <tr class="top">
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td class="title">
                                            <img src="https://minazi.store/en/assets/img/minazi.png" alt="minazi.store" style="width: 100%; max-width: 300px" />
                                        </td>

                                        <td>
                                            Invoice #: '.$orderid.'<br />
                                            Created: '.date('jS F, Y').'
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="information">
                            <td colspan="2">
                                <table>
                                    <tr>
                                        <td>
                                            support@minazi.store,<br />
                                            +971521398226,<br />
                                            +233554660985
                                        </td>

                                        <td>
                                            '.$_SESSION['cust-name'].',<br />
                                            '.$_SESSION['cust-add1'].',<br />
                                            '.$_SESSION['cust-add2'].'
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="heading">
                            <td>Payment Method</td>

                            <td>Status</td>
                        </tr>

                        <tr class="details">
                            <td>FlutterWave</td>

                            <td>Paid</td>
                        </tr>

                        <tr class="heading">
                            <td>Item</td>

                            <td>Price</td>
                        </tr>

                        <tr class="item last">
                            <td>Food and Herbal Stuffs </td>

                            <td>'.curcy().number_format($cart->getAttributeTotal('price'), 2, '.', ',').'</td>
                        </tr>

                        <tr class="total">
                            <td></td>

                            <td>Total: '.curcy().number_format($cart->getAttributeTotal('price') + deliv(), 2, '.', ',').'</td>
                        </tr>
                    </table>
                </div>
            </body>
        </html>'; 
        
        // Set content-type header for sending HTML email 
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        mail($to, $subject, $htmlContent, $headers);

        unset($_SESSION['tx_ref']);
        unset($_SESSION['order_id']);
        unset($_SESSION['newest_p']);
        unset($_SESSION['cust-name']);
        unset($_SESSION['cust-add1']);
        unset($_SESSION['cust-add2']);
        $_SESSION['sess-ready'] = false;
        $cart->clear();

        //Head to Completion of Order
        header('Location: invoice.php');
    }elseif($status == 'failed'){
        $_SESSION['pay_msg'] = 'Payment Failed!';
        header('Location: checkout.php');
    }
}
