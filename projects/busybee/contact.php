<?php
$title = "Contact Us | Busy Bee Snacks- Bringing Health to the Hive ";
$description = "If you have any questions, please use the contact form to get in touch with us at Busy Bee Snacks. ";
include("header.php");
//connects to db
require_once("connect-db.php");
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $purpose = test_input($_POST["purpose"]);
    $msg = test_input($_POST["msg"]);

    $sql = "insert into contact (name, email, purpose, msg) values (:name, :email, :purpose, :msg)";
    $statement1 = $db->prepare($sql);
    $statement1->bindValue(":name", $name);
    $statement1->bindValue(":email", $email);
    $statement1->bindValue(":purpose", $purpose);
    $statement1->bindValue(":msg", $msg);
    if ($statement1->execute()) {
        $account = $statement1->fetchAll();
        $statement1->closeCursor();
?>
<script>
window.location.replace("contact-success.php")
</script>
<?php
    } else {
        echo "<h4>Error entering contact information</h4>";
    }
}
?>
<section class="contact">
    <article>
        <div class="contact-container">
            <div class="all-cards">
                <div class="card">
                    <div class="card-container">
                        <h4><b>Phone</b></h4>
                        <p class="card-info">888-555-BUSY</p>
                        <p>Sunday, 8am - 4:30m ET</p>
                        <p>Monday - Thursday, 8am - 8pm ET</p>
                        <p>Friday - Saturday, 8am - 6:30pm ET</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-container">
                        <h4><b>Email</b></h4>
                        <p class="card-info">Busy@Bee.com</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-container">
                        <h4><b>Mail</b></h4>
                        <p>525 BeeWay Ln</p>
                        <p>Bee Town, Colorado</p>
                        <p>052648</p>
                    </div>
                </div>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="side-contact">
                <h1>Contact Us</h1>
                <p>We love to hear from you and we love to help you! We really do care, so when you contact us, we will
                    respond quickly. For all press and media related inquiries, please visit our Media / Press section.
                    Use the form below to send us a message directly!</p>
                <div class="input-container">
                    <label for="name">Name</label><br>
                    <input type="text" name="name">
                </div>
                <div class="input-container">
                    <label for="email">Email</label><br>
                    <input type="email" name="email">
                </div>
                <div class="input-container full">
                    <label for="purpose">Purpose</label><br>
                    <select id="purpose" name="purpose">
                        <option disabled value="default">-- Please Select One --</option>
                        <option value="order">Report Problem with Order</option>
                        <option value="question">Ask a Question about a Product</option>
                        <option value="general">General Business, Donation, or Press Inquiry</option>
                        <option value="tech">Report Technical Issue</option>
                    </select>
                </div>
                <div class="input-container full">
                    <label for="msg">Message</label><br>
                    <textarea name="msg"></textarea>
                </div>
                <button class="btn-primary contact">Submit</button>
            </form>
        </div>




    </article>
</section>
<?php include("footer.php") ?>