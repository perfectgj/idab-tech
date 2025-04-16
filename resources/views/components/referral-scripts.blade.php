<!-- FontAwesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- intl-tel-input -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>

<script>
    const registerUrl = "{{ url('/register') }}";
    const referralCode = document.getElementById('referralCode').value;
    const referralLink = `${registerUrl}?ref=${referralCode}`;

    function shareWhatsApp() {
        window.open(`https://wa.me/?text=${encodeURIComponent("Join using my referral: " + referralLink)}`, '_blank');
    }

    function shareSMS() {
        window.open(`sms:?body=${encodeURIComponent("Register using my referral: " + referralLink)}`, '_self');
    }

    function shareEmail() {
        window.open(`mailto:?subject=Referral&body=Join me here: ${referralLink}`, '_self');
    }

    function copyUserId() {
        const input = document.getElementById("referralCode");

        if (input) {
            // Select the input text
            input.select();
            input.setSelectionRange(0, 99999); // For mobile support

            // Copy to clipboard
            navigator.clipboard.writeText(input.value).then(() => {
                alert("Referral code copied!");
            }).catch(err => {
                console.error("Failed to copy:", err);
                alert("Failed to copy referral code.");
            });
        } else {
            alert("Referral code input not found.");
        }
    }


    const iti = intlTelInput(document.querySelector("#phone"), {
        separateDialCode: true,
        preferredCountries: ["in", "us"],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js",
    });

    function sendWhatsAppMessage() {
        if (!iti.isValidNumber()) return alert("Invalid number.");
        const number = iti.getNumber().replace(/\D/g, '');
        const msg = `Join my network using this referral: ${referralLink}`;
        window.open(`https://wa.me/${number}?text=${encodeURIComponent(msg)}`, '_blank');
    }
</script>
