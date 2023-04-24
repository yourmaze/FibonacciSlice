<DOCTYPE html>
    <html>
        <head>
        </head>
        <body>
        <form>
            <p>
                From:
                <br>
                <input type="number" id="from" name="from"value="1">
            </p>
            <p>
                To:
                <br>
                <input type="number" id="to" name="to" value="1">
            </p>
            <p>
                <input type="submit" value="Submit">
            </p>
        </form>

        <div id="result"></div>

        <script src="js/jquery.js"></script>
        <script>
            $(document).on('submit', 'form', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'fibonacci',
                    dataType: 'json',
                    data: {
                        from: $('#from').val(),
                        to: $('#to').val(),
                    },
                    success: function(data) {
                        console.log(data);
                        $('#result').text(data);
                    },
                });
            });
        </script>

        </body>
    </html>