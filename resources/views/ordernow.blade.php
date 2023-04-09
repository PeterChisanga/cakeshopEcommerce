@extends('master')
@section("content")


<style>
.custom-cartlist-container {
    background: radial-gradient(#fff, #ffd6d6);
    padding: 40px 100px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    font-size: 1.2rem;
    margin-bottom:100px;
    margin-top: 20px;
}

.custom-cartlist-container table {
    margin-bottom: 20px;
}

.custom-cartlist-container td:first-child {
    font-weight: bold;
}

.custom-cartlist-container textarea {
    height: 80px;
}

.custom-cartlist-container label {
    font-weight: bold;
}

@media (max-width: 760px) {
    .custom-cartlist-container {
    padding: 20px;
    font-size: 1.2rem;
    margin-bottom:0px;
        margin-top:0px;
    border-radius:0px;
    }

    .custom-cartlist-container table {
        font-size: 1rem;
    }
}

</style>

<div class="container custom-cartlist-container">
    <div class="col-sm-10">
        <table class="table">
            <tbody>
                <tr>
                    <td>Amount</td>
                    <td>{{$total}} Dh</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>0 Dh</td>
                </tr>
                <tr>
                    <td>Delivery</td>
                    <td>10 Dh</td>
                </tr>
                <tr>
                    <td>Total Amount</td>
                    <td>{{$total + 10}} Dh</td>
                </tr>
            </tbody>
        </table>
        <div>
            <form action="/orderplace" method="POST">
                @csrf
                <div class="form-group">
                    <textarea type="text" name="address" placeholder="Enter Your Address" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="payment">Payment Method</label><br>
                    <input type="radio" value="online" name="payment" id="online">
                    <label for="online">Online Payment</label><br>
                    <input type="radio" value="emi" name="payment" id="emi">
                    <label for="emi">EMI Payment</label><br>
                    <input type="radio" value="cod" name="payment" id="cod">
                    <label for="cod">Payment on Delivery</label><br>
                </div>
                <button type="submit" class="btn btn-success">Submit</button><br>
                <p>Once you submit the order, you will receive an email and text message on your phone number.</p>
            </form>
        </div>
    </div>
</div>

@endsection 