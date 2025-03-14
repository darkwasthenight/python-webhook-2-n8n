<?php
// n8n Webhook Integration via PHP

// Specify your n8n webhook URL (update with your actual n8n instance URL and webhook path)
$n8nWebhookUrl = 'https://your-n8n-instance.com/webhook/myWebhook';

// Prepare the data payload that your n8n workflow expects.
// This could be an event, order details, or any other data you want to process in n8n.
$payload = array(
    'event' => 'order_created',
    'order' => array(
        'id'       => 12345,
        'total'    => 99.99,
        'customer' => array(
            'name'  => 'Jane Doe',
            'email' => 'jane@example.com'
        )
    ),
    'timestamp' => date('c') // ISO 8601 formatted timestamp
);

// Convert the PHP array to a JSON string
$jsonData = json_encode($payload);

// Initialize a cURL session to send the POST request to n8n
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $n8nWebhookUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));

// Execute the cURL request and capture the response
$response = curl_exec($ch);

// Check if any cURL error occurred
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Display the response from the n8n webhook
    echo 'Response from n8n: ' . $response;
}

// Close the cURL session
curl_close($ch);
?>
