<template>
    <BContainer class="px-5 py-2">
        <BRow
            ><BCol><H3>CREATE NEW INVOICE</H3></BCol></BRow
        >
        <BRow class="my-3">
            <BCol cols="2">
                <BFormGroup label="Invoice Date:">
                    <BFormInput
                        v-model="invoice_date"
                        type="date"
                    ></BFormInput></BFormGroup
            ></BCol>

            <BCol cols="4">
                <BFormGroup label="Invoice Number:">
                  <BInputGroup class="mb-2 mr-sm-2 mb-sm-0"   >
                    <BFormInput
                        v-model="invoice_number"
                        type="text"
                         disabled
                    ></BFormInput>
                    <BInputGroupAppend>
        <BButton @click="generateInvoiceNumber" variant="primary">Generate</BButton>
      </BInputGroupAppend>
                  </BInputGroup>
                    </BFormGroup
            ></BCol>
            <BCol cols="3">
                <BFormGroup label="Delivery Type:">
                  <BFormSelect v-model="delivery_type" id="deliveryType">
          <option value="office">Office Delivery</option>
          <option value="shop">Shop Delivery</option>
    </BFormSelect>
    </BFormGroup
            ></BCol>
        </BRow>
        <BRow  class="mb-3">
        <BCol cols="12">
        <BCardGroup deck>
        <BCard header="Customer Details">
        <BRow>
  <BCol cols="6">
          <BFormGroup   class="mb-2">
                  <BInputGroup  prepend="Customer Name">
                    <BFormInput
                        v-model="customer.name"
                        type="text"
                        placeholder="Customer Name"
                    ></BFormInput>
                  
                  </BInputGroup>
                    </BFormGroup >
                    </BCol>
                   <BCol cols="6">
                    <BFormGroup   class="mb-2">
                  <BInputGroup  prepend="Company Name">
                    <BFormInput
                        v-model="customer.company_name"
                        type="text"
                        placeholder="Company Name"
                    ></BFormInput>
                  
                  </BInputGroup>
                    </BFormGroup>
                    </BCol>
                    <BCol cols="6">
                      <BFormGroup   class="mb-2">
                  <BInputGroup  prepend="Address">
                      <BFormTextarea
                                        v-model="customer.address"
                                        placeholder="Enter Customer Address"
                                        rows="3"
                                    ></BFormTextarea>
                                    </BInputGroup></BFormGroup>
                    </BCol>
                    <BCol cols="6">   <BFormGroup   class="mb-2">
                  <BInputGroup  prepend="Phone">
                    <BFormInput
                        v-model="customer.phone"
                        type="number"
                        placeholder="Company Name"
                    ></BFormInput>
                  
                  </BInputGroup>
                    </BFormGroup>
                    <BFormGroup   class="mb-2">
                  <BInputGroup  prepend="Email">
                    <BFormInput
                        v-model="customer.email"
                        type="email"
                        placeholder="Email Address"
                    ></BFormInput>
                  
                  </BInputGroup>
                    </BFormGroup>  
                  </BCol>
                  <BCol cols="6">
                    <BFormGroup   class="mb-2">
                    <BInputGroup  prepend="GST #">
                    <BFormInput
                        v-model="customer.gst"
                        type="text"
                        placeholder="Gst Number"
                    ></BFormInput>
                  
                  </BInputGroup>
                    </BFormGroup> 
                  </BCol>
                  <BCol cols="6">
                <BFormGroup>
                    <BInputGroup  prepend="GST %">
                  <BFormSelect v-model="gst_percentage">
          <option value="12">GST 12% </option>
          <option value="18">GST 18% </option>
          <option value="24">GST 24% </option>
          <option value="28">GST 28% </option>
    </BFormSelect>
</BInputGroup>
    </BFormGroup
            ></BCol>
                    </BRow>
                    
        </BCard>
      </BCardGroup>
      </BCol>
        </BRow>
        <BRow>
            <BCol cols="12">
              <BCardGroup deck>
                <BCard class="shadow shadow-sm">
                    <BTableSimple
                        hover
                        small
                        class="text-center"
                        bordered
                        responsive
                    >
                        <BThead variant="light">
                            <BTr>
                                <BTh
                                    ><BButton
                                        size="sm"
                                        class="btn btn-primary rounded-circle"
                                        v-on:click="addProduct"
                                        ><FontAwesomeIcon
                                            icon="plus" /></BButton
                                ></BTh>
                                <BTh width="50%">Product</BTh>
                                <BTh>Hsn Code</BTh>
                                <BTh>Qty</BTh>
                                <BTh>Price</BTh>
                                <BTh>Uom</BTh>
                            </BTr>
                        </BThead>
                        <BTbody>
                            <BTr
                                v-for="(product, index) in products"
                                :key="index"
                            >
                                <BTd>
                                    <BButton
                                        size="sm"
                                        class="btn-danger rounded-circle"
                                        @click="removeProduct(index)"
                                        ><FontAwesomeIcon
                                            icon="trash" /></BButton
                                ></BTd>
                                <BTd>
                                    <BFormTextarea
                                        v-model="product.description"
                                        placeholder="Enter description"
                                        rows="1"
                                    ></BFormTextarea>
                                </BTd>
                                <BTd
                                    ><BFormInput
                                        v-model="product.hsnCode"
                                        placeholder="Enter HSN code"
                                    ></BFormInput
                                ></BTd>
                                <BTd
                                    ><BFormInput
                                        v-model="product.quantity"
                                        type="number"
                                        placeholder="Enter quantity"
                                    ></BFormInput
                                ></BTd>
                                <BTd>
                                    <BFormInput
                                        v-model="product.rate"
                                        type="number"
                                        placeholder="Enter rate"
                                    ></BFormInput
                                ></BTd>
                                <BTd>
                                    <BFormInput
                                    type="text"
                                    v-model="product.uom"
                                        placeholder="Enter UOM"
                                    ></BFormInput
                                ></BTd>
                            </BTr>
                        </BTbody>
                    </BTableSimple> </BCard
            ></BCardGroup></BCol> </BRow
        ><BRow>
            <BCol cols="12" class="d-flex m-2">
                <BButton class="m-auto btn btn-success" @click="generatePDF"
                    >Generate PDF</BButton
                >
            </BCol>
        </BRow>
    </BContainer>
    <div class="mb-5">
        <div
            class="invoice"
            style="
                max-width: 210mm;
                padding: 5mm 0;
                margin: auto;
                background-color: #fff;
                font-family: Arial, sans-serif;
                color: #27374d;
            "
        >
            <div
                style="
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    text-align: center;
                "
            >
                <h3
                    style="
                        font-weight: normal;
                        text-transform: uppercase;
                        font-family: 'Abril Fatface', cursive;
                    "
                >
                    INVOICE
                </h3>
            </div>
            <hr
                style="
                    height: 1px;
                    color: #27374d;
                    background-color: #27374d;
                    margin: 0;
                "
            />

            <!-- Two Columns Layout -->
            <div style="display: flex; align-items: center; padding: 2mm 0">
                <!-- Left Column for Logo -->
                <div
                    id="logo"
                    style="
                        flex: 1;
                        display: flex;
                        text-align: center;
                        padding-left: 20mm;
                    "
                >
                    <img
                        src="http://127.0.0.1:8000/logo/logo6.png"
                        alt="Company Logo"
                        style="max-width: 100%; height: 20mm"
                    />
                    <div>
                        <h1
                            style="
                                font-weight: normal;
                                font-size: 60px;
                                color: #27374d;
                                margin: 0;
                                text-transform: uppercase;
                                font-family: 'Abril Fatface', cursive;
                            "
                        >
                            ICS
                        </h1>
                        <h6
                            style="
                                font-weight: normal;
                                color: #27374d;
                                font-family: 'Abril Fatface', cursive;
                            "
                        >
                            Creations
                        </h6>
                    </div>
                </div>
                <!-- Right Column for Details -->
                <div id="company_info" style="flex: 1; color: #27374d">
                    <ul
                        style="
                            list-style-type: none;
                            font-size: 0.9rem;
                            font-weight: bold;
                            padding: 0 10mm;
                            margin: 0;
                        "
                    >
                        <li>123 Main Street, City, Country</li>
                        <li>Phone: +1 (123) 456-7890</li>
                        <li>
                            Email:<span style="text-transform: lowercase"
                                >info@ICScreation.com</span
                            >
                        </li>
                        <li>GST# : 1234567890</li>
                    </ul>
                </div>
            </div>
            <hr
                style="
                    height: 2px;
                    color: #27374d;
                    background-color: #27374d;
                    margin: 0;
                "
            />
            <div style="display: flex; align-items: center; padding: 2mm 0 0 0">
                <div style="flex: 1; color: #27374d; padding-left: 20mm">
                    <h6 style="font-weight: bolder; padding: 0; margin: 0">
                        <u>Delivery To</u>:
                    </h6>
                    <p
                    v-if="customer.name"
                        style="
                            padding: 0;
                            margin: 0;
                            font-weight: bold;
                            text-transform: uppercase;
                        "
                    >
                        <b>{{customer.name}}</b>
                    </p>
                     <p
                     v-if="customer.company_name"
                        style="
                            padding: 0;
                            margin: 0;
                            font-weight: bold;
                            text-transform: uppercase;
                        "
                    >
                        <b>{{customer.company_name}}</b>
                    </p>
                    <ul
                        style="
                            list-style-type: none;
                            font-size: 0.95rem;
                            font-weight: normal;
                            padding: 0;
                            margin: 0;
                        "
                    >
                        <li>{{customer.address}}</li>
                        <li>Phone: {{customer.phone}}</li>
                        <li>Email: {{customer.email}}</li>
                        <li><strong>GST# : {{customer.gst}}</strong></li>
                    </ul>
                </div>
                <div style="flex: 1; color: #27374d; padding: 0">
                    <ul
                        style="
                            list-style-type: none;
                            font-weight: bold;
                            margin: 0;
                            line-height: 2.5rem;
                        "
                    >
                        <li>Invoice Number: {{invoice_number}}</li>
                        <li>Invoice Date: {{ formatDate(invoice_date) }}</li>
                        <li>Transport: {{delivery_type}}</li>
                    </ul>
                </div>
            </div>

            <div style="padding: 2mm 10mm 0 10mm">
                <table style="width: 100%; margin: 0 auto; text-align: center">
                    <thead>
                        <tr>
                            <th style="padding: 10px">S.No</th>
                            <th style="padding: 10px">Description of Goods</th>
                            <th style="padding: 10px">HSN Code</th>
                            <th style="padding: 10px">Quantity</th>
                            <th style="padding: 10px">Rate</th>
                            <th style="padding: 10px">UOM</th>
                            <th style="padding: 10px">Amount</th>
                        </tr>
                    </thead>
                    <tbody style="color: #27374d; line-height: 2rem">
                        <!-- Add your table rows here -->
                        <tr
                            style="line-height: 2rem; color: #27374d"
                            v-for="(product, index) in products"
                            :key="index"
                        >
                            <td>{{ index + 1 }}</td>
                            <td>{{ product.description }}</td>
                            <td>{{ product.hsnCode }}</td>
                            <td>{{ product.quantity }}</td>
                            <td>{{ formattedAmount(product.rate) }}</td>
                            <td>{{ product.uom.toUpperCase() }}</td>
                            <td>
                                {{
                                    formattedAmount(
                                        product.quantity * product.rate
                                    )
                                }}
                            </td>
                        </tr>

                        <tr  v-if="products.length<8"
                            style="line-height: 2rem; color: #27374d"
                            v-for="extraRow in (8 - products.length)"
                        >
                            <td colspan="7">&nbsp;</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr style="line-height: 2rem; color: #27374d">
                            <td
                                colspan="6"
                                style="
                                    text-align: right;
                                    font-weight: bold;
                                    padding: 5px;
                                "
                            >
                                Sub Total
                            </td>
                            <td style="padding: 5px">
                                {{ formattedAmount(subtotal) }}
                            </td>
                        </tr>
                        <tr style="line-height: 2rem; color: #27374d">
                            <td
                                colspan="6"
                                style="
                                    text-align: right;
                                    font-weight: bold;
                                    padding: 5px;
                                "
                            >
                                CGST ({{(gst_percentage/2)}}%)
                            </td>
                            <td style="padding: 5px">
                                {{ formattedAmount((subtotal *(gst_percentage/2)) / 100) }}
                            </td>
                        </tr>
                        <tr style="line-height: 2rem; color: #27374d">
                            <td
                                colspan="6"
                                style="
                                    text-align: right;
                                    font-weight: bold;
                                    padding: 5px;
                                "
                            >
                                SGST ({{(gst_percentage/2)}}%)
                            </td>
                            <td style="padding: 5px">
                                {{ formattedAmount((subtotal *(gst_percentage/2)) / 100) }}
                            </td>
                        </tr>
                        <tr style="line-height: 2rem; color: #27374d">
                            <td
                                colspan="6"
                                style="
                                    text-align: right;
                                    font-weight: bold;
                                    padding: 5px;
                                "
                            >
                                Grand Total
                            </td>
                            <td style="padding: 5px">
                                {{
                                    formattedAmount(
                                        subtotal + (subtotal * gst_percentage) / 100
                                    )
                                }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Declaration and Seal/Signature Area Design 9 -->
            <div
                class="declaration-and-seal"
                style="
                    display: flex;
                    background-color: #fff;
                    padding: 10mm 10mm 0 20mm;
                "
            >
                <!-- Left Half for Declaration -->
                <div class="declaration-half" style="flex: 1">
                    <p
                        style="
                            font-size: 14px;
                            font-weight: bold;
                            color: #27374d;
                        "
                    >
                        DECLARATION
                    </p>
                    <p style="font-size: 14px">
                        We hereby declare that this invoice is a true
                        representation of the goods sold and all information is
                        accurate.
                    </p>
                </div>
                <!-- Right Half for Seal/Signature -->
                <div class="seal-half" style="flex: 1; text-align: center">
                    <h6><strong>For ICS CREATIONS</strong></h6>
                    <div style="height: 30px"></div>
                    <h6><strong>Authorized Signatory</strong></h6>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Anton&family=Fredericka+the+Great&display=swap");

tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}
thead tr:nth-child(odd) {
    background-color: #eff0f1;
}
tfoot tr:first-child {
    background-color: #eff0f1;
}
tfoot tr:last-child {
    background-color: #eff0f1;
}
table,
tr {
    border: 1px solid #27374d;
}
table {
    width: 100%;
    border-radius: 1rem;
    overflow: hidden;
}
</style>

<script setup>
import { ref, computed } from "vue";
import html2pdf from "html2pdf.js";
import { useGeneralStore } from "@/stores/general.js";
const { formattedAmount } = useGeneralStore();
const invoice_date = ref(getCurrentDate());
const invoice_number=ref('ICS202301001');
const delivery_type=ref('office');
const gst_percentage=ref('12');

const invoiceNumberPrefix = 'ICS';
let incrementingNumber = 1;

const generateInvoiceNumber = () => {
  const d = new Date();
  invoice_number.value = `${invoiceNumberPrefix}${d.getFullYear()}${(d.getMonth() + 1).toString().padStart(2, '0')}${(incrementingNumber++).toString().padStart(3, '0')}`;
};

function getCurrentDate() {
    const today = new Date();
    const year = today.getFullYear();
    let month = today.getMonth() + 1;
    let day = today.getDate();

    // Ensure month and day are formatted as two digits
    if (month < 10) {
        month = `0${month}`;
    }
    if (day < 10) {
        day = `0${day}`;
    }

    // Return the date in YYYY-MM-DD format
    return `${year}-${month}-${day}`;
}
function formatDate(inputDate) {
    const date = new Date(inputDate);
    const options = { year: "numeric", month: "2-digit", day: "2-digit" };
    const formattedDate = date.toLocaleDateString("en-GB", options); // Adjust the locale as needed
    return formattedDate;
}

const customer=ref({
  name:"Imran",
  company_name:"XYZ Company",
  email:"company@mail.com",
  phone:"9876543210",
  address:"321 chennai- 635810",
  gst:"GST123"
});
const products = ref([
    {
        description: "Widget A",
        hsnCode: "123456",
        quantity: 100,
        rate: 5,
        uom: "PCS",
    },
    {
        description: "Widget B",
        hsnCode: "789012",
        quantity: 50,
        rate: 8,
        uom: "PCS",
    },
    // Add more data objects as needed
]);

const subtotal = computed(() => {
    let total = 0;
    for (const product of products.value) {
        total += product.quantity * product.rate;
    }
    return total;
});

const generatePDF = async () => {
    const invoiceElement = document.querySelector(".invoice");

    const pdfOptions = {
        filename: "invoice.pdf",
        image: { type: "jpeg", quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: {
            unit: "mm",
            format: "a4",
            orientation: "portrait",
            compress: true, // Enable font subsetting
        },
    };

    let worker = await html2pdf()
        .set(pdfOptions)
        .from(invoiceElement)
        .toPdf()
        .output("blob")
        .then((data) => {
            const blob = new Blob([data], { type: "application/pdf" });

            const url = URL.createObjectURL(blob);
            window.open(url, "_blank");
            URL.revokeObjectURL(url);
        });
};
const addProduct = () => {
    // Add a new product object to the products array
    products.value.push({
        description: "",
        hsnCode: "",
        quantity: 0,
        rate: 0,
        uom: "",
    });
};
const removeProduct = (index) => {
    // Use splice to remove the product at the specified index
    products.value.splice(index, 1);
};
</script>
