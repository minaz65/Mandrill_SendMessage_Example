<?php
require 'header.php';
try {
    //initialize the Mandrill class with API KEY
    $mandrill = new Mandrill('-7khFBuxhClaT3cDpLNw8Q');
    //set parameters
    $message = array(
        'html' => '<p>Example HTML content</p>',
        //optional full text content
        'text' => 'Example text content',
        //the message subject
        'subject' => 'welcome message',
        //the sender email address email
        'from_email' => 'minazebarjadan@gmail.com',
        //optional from name
        'from_name' => 'Mina',
        //an array of recipient information
        'to' => array(
            array(
                //the email address of the recipient-required
                'email' => 'minaz65@yahoo.com',
                //the optional display name to use for the recipient
                'name' => 'Mina',
                //the header type to use for the recipient, defaults to "to" if not provided oneof(to, cc, bcc)
                'type' => 'to'
            )
        ),
        //optional extra headers to add to the message
        'headers' => array('Reply-To' => 'minazebarjadan@gmail.com'),
    );
    //saves an array in the result
    $result = $mandrill->messages->send($message);

    ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Email</th>
                <th>Status</th>
                <th>Id</th>

            </tr>
            </thead>

            <?php
            //create an array of items
            $items = array();
            //loop trough an array to get sent messages' subjects, emails, senders, sizes and statuses
            foreach ($result as $key => $value) {
                echo '<tr>
                     <td>' . $value['email'] . '</td>' .
                    '<td>' . $value['status'] . '</td>'.
                    '<td>' . $value['_id'] . '</td>';

            }
            ?>
        </table>
    </div>

<?php
} catch (Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
    throw $e;
}
require 'footer.php';
?>
