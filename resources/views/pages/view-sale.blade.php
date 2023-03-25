<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{asset('style.css')}}" media="all" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

  </head>
  <body>
      <header class="clearfix">
        <div class="row d-flex justify-content-between">
          <div class="col">
          <a href="{{ route('sale.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left-short"></i>Back</a>
        </div>
          <div class="col" id="logo">
            <img src="{{asset('logo.png')}}">
          </div>
          <div class="col">
            <button class="btn btn-success float-end"><i class="bi bi-printer me-2"></i>Print</button>
          </div>
        </div>

        <h1>INVOICE 3-2-1</h1>
        <div id="company" class="clearfix">
          <div>Company Name</div>
          <div>455 Foggy Heights,<br /> AZ 85004, US</div>
          <div>(602) 519-0450</div>
          <div><a href="mailto:company@example.com">company@example.com</a></div>
        </div>
        <div id="project">
          <div><span>PROJECT</span> Website development</div>
          <div><span>CLIENT</span> John Doe</div>
          <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
          <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
          <div><span>DATE</span> August 17, 2015</div>
          <div><span>DUE DATE</span> September 17, 2015</div>
        </div>
      </header>
      <main>
        <table>
          <thead>
            <tr>
              <th class="service">SERVICE</th>
              <th class="desc">DESCRIPTION</th>
              <th>PRICE</th>
              <th>QTY</th>
              <th>TOTAL</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="service">Design</td>
              <td class="desc">Creating a recognizable design solution based on the company's existing visual identity</td>
              <td class="unit">$40.00</td>
              <td class="qty">26</td>
              <td class="total">$1,040.00</td>
            </tr>
            <tr>
              <td class="service">Development</td>
              <td class="desc">Developing a Content Management System-based Website</td>
              <td class="unit">$40.00</td>
              <td class="qty">80</td>
              <td class="total">$3,200.00</td>
            </tr>
            <tr>
              <td class="service">SEO</td>
              <td class="desc">Optimize the site for search engines (SEO)</td>
              <td class="unit">$40.00</td>
              <td class="qty">20</td>
              <td class="total">$800.00</td>
            </tr>
            <tr>
              <td class="service">Training</td>
              <td class="desc">Initial training sessions for staff responsible for uploading web content</td>
              <td class="unit">$40.00</td>
              <td class="qty">4</td>
              <td class="total">$160.00</td>
            </tr>
            <tr>
              <td colspan="4">SUBTOTAL</td>
              <td class="total">$5,200.00</td>
            </tr>
            <tr>
              <td colspan="4">TAX 25%</td>
              <td class="total">$1,300.00</td>
            </tr>
            <tr>
              <td colspan="4" class="grand total">GRAND TOTAL</td>
              <td class="grand total">$6,500.00</td>
            </tr>
          </tbody>
        </table>
        <div id="notices">
          <div>NOTICE:</div>
          <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div>
      </main>
      <footer>
        Invoice was created on a computer and is valid without the signature and seal.
      </footer>
  </body>
</html>