<template>
    <BContainer class="px-5 my-1">
        <BRow
            ><BCol><h3>CREATE NEW INVOICE</h3></BCol></BRow
        >
        <BRow class="my-2">
            <BCol cols="3">
                <BFormGroup>
                    <BFormInput
                        size="md"
                        v-model="InvoiceDate"
                        type="date"
                    ></BFormInput></BFormGroup
            ></BCol>

            <BCol cols="3">
                <BFormGroup>
                    <BInputGroup size="md" class="mb-2 mr-sm-2 mb-sm-0">
                        <BFormInput
                            v-model="InvoiceNumber"
                            type="text"
                            disabled
                        ></BFormInput>
                        <BInputGroupAppend>
                            <BButton
                                v-on:click="generateInvoiceNumber"
                                variant="primary"
                                >Generate</BButton
                            >
                        </BInputGroupAppend>
                    </BInputGroup>
                </BFormGroup></BCol
            >
            <BCol cols="3">
                <BFormGroup>
                    <BInputGroup size="md" prepend="GST %">
                        <BFormSelect v-model="GstPercentage">
                            <option value="12">GST 12%</option>
                            <option value="18">GST 18%</option>
                            <option value="24">GST 24%</option>
                            <option value="28">GST 28%</option>
                        </BFormSelect>
                    </BInputGroup>
                </BFormGroup></BCol
            >
            <BCol cols="3">
                <BFormGroup>
                    <BFormSelect
                        size="md"
                        v-model="DeliveryType"
                        id="deliveryType"
                    >
                        <option value="office">Office Delivery</option>
                        <option value="shop">Shop Delivery</option>
                    </BFormSelect>
                </BFormGroup></BCol
            >
        </BRow>
        <BRow class="mb-2">
            <BCol cols="12">
                <BCardGroup deck>
                    <BCard>
                        <BModal
                                    v-model="modal"
                                    title="Choose Customer"
                                    size="lg"
                                    hide-header
                                    hide-footer
                            
                                >
                            <BTableSimple  hover
                            small
                            class="text-center"
                            bordered
                            responsive></BTableSimple>
                            </BModal>
                        <template #header> Customer Details  - 
                             <span
             size="sm"
               @click="modal = !modal"
               variant="outline-dark"
               class="text-primary"
             >Select Customer</span
             ></template>
                        <BRow>
                            <BCol cols="6">
                                <BFormGroup class="mb-2">
                                    <BInputGroup
                                        size="md"
                                        prepend="Customer Name"
                                    >
                                        <BFormInput
                                            v-model="customer.name"
                                            type="text"
                                            placeholder="Customer Name"
                                        ></BFormInput>
                                    </BInputGroup>
                                </BFormGroup>
                            </BCol>
                            <BCol cols="6">
                                <BFormGroup class="mb-2">
                                    <BInputGroup
                                        size="md"
                                        prepend="Company Name"
                                    >
                                        <BFormInput
                                            v-model="customer.company_name"
                                            type="text"
                                            placeholder="Company Name"
                                        ></BFormInput>
                                    </BInputGroup>
                                </BFormGroup>
                            </BCol>
                            <BCol cols="6">
                                <BFormGroup class="mb-2">
                                    <BInputGroup size="md" prepend="Address">
                                        <BFormTextarea
                                            v-model="customer.address"
                                            placeholder="Enter Customer Address"
                                            rows="1"
                                        ></BFormTextarea> </BInputGroup
                                ></BFormGroup>
                                <BFormGroup class="mb-2">
                                    <BInputGroup size="md" prepend="GST #">
                                        <BFormInput
                                            v-model="customer.gst"
                                            type="text"
                                            placeholder="Gst Number"
                                        ></BFormInput>
                                    </BInputGroup>
                                </BFormGroup>
                            </BCol>
                            <BCol cols="6">
                                <BFormGroup class="mb-2">
                                    <BInputGroup size="md" prepend="Phone">
                                        <BFormInput
                                            v-model="customer.phone"
                                            type="number"
                                            placeholder="Company Name"
                                        ></BFormInput>
                                    </BInputGroup>
                                </BFormGroup>
                                <BFormGroup class="mb-2">
                                    <BInputGroup size="md" prepend="Email">
                                        <BFormInput
                                            v-model="customer.email"
                                            type="email"
                                            placeholder="Email Address"
                                        ></BFormInput>
                                    </BInputGroup>
                                </BFormGroup>
                            </BCol>
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
                                            v-on:click="removeProduct(index)"
                                            ><FontAwesomeIcon
                                                icon="trash" /></BButton
                                    ></BTd>
                                    <BTd>
                                        <BFormTextarea
                                            size="md"
                                            v-model="product.description"
                                            placeholder="Enter description"
                                            rows="1"
                                        ></BFormTextarea>
                                    </BTd>
                                    <BTd
                                        ><BFormInput
                                            size="md"
                                            v-model="product.hsnCode"
                                            placeholder="Enter HSN code"
                                        ></BFormInput
                                    ></BTd>
                                    <BTd
                                        ><BFormInput
                                            size="md"
                                            v-model="product.quantity"
                                            type="number"
                                            placeholder="Enter quantity"
                                        ></BFormInput
                                    ></BTd>
                                    <BTd>
                                        <BFormInput
                                            size="md"
                                            v-model="product.rate"
                                            type="number"
                                            placeholder="Enter rate"
                                        ></BFormInput
                                    ></BTd>
                                    <BTd>
                                        <BFormInput
                                            size="md"
                                            type="text"
                                            v-model="product.uom"
                                            placeholder="Enter UOM"
                                        ></BFormInput
                                    ></BTd>
                                </BTr>
                            </BTbody>
                        </BTableSimple> </BCard></BCardGroup
            ></BCol>
        </BRow>
        <BRow>
            <BCol cols="12" class="my-2">
                <BButton
                    size="md"
                    variant="success"
                    class="mx-2"
                    v-on:click="generatePDF"
                    ><FontAwesomeIcon
                        icon="file-invoice"
                        class="me-2"
                    />Generate</BButton
                ><BButton
                    size="md"
                    variant="secondary"
                    class="mx-2"
                    v-on:click="downloadInvoice"
                    ><FontAwesomeIcon
                        icon="download"
                        class="me-2"
                    />Download</BButton
                >
            </BCol>
        </BRow>
    </BContainer>

    <div class="invoice">
        <InvoiceDesign
            v-if="showInvoice"
            :customer="customer"
            :InvoiceNumber="InvoiceNumber"
            :DeliveryType="DeliveryType"
            :InvoiceDate="InvoiceDate"
            :products="products"
            :GstPercentage="GstPercentage"
        />
    </div>
</template>

<script setup>
import { ref, defineAsyncComponent } from "vue";
import html2pdf from "html2pdf.js";

const InvoiceDesign = defineAsyncComponent(() => import("./invoiceDesign.vue"));

const showInvoice = ref(false);
const modal=ref(false);
const InvoiceDate = ref(getCurrentDate());
const InvoiceNumber = ref("ICS202301001");
const DeliveryType = ref("office");
const GstPercentage = ref("12");
const invoiceNumberPrefix = "ICS";
let incrementingNumber = 1;

const generateInvoiceNumber = () => {
    const d = new Date();
    InvoiceNumber.value = `${invoiceNumberPrefix}${d.getFullYear()}${(
        d.getMonth() + 1
    )
        .toString()
        .padStart(2, "0")}${(incrementingNumber++)
        .toString()
        .padStart(3, "0")}`;
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

const customer = ref({
    name: "Imran",
    company_name: "XYZ Company",
    email: "company@mail.com",
    phone: "9876543210",
    address: "321 chennai- 635810",
    gst: "GST123",
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

const downloadInvoice = async () => {
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

    const invoiceElement = document.querySelector(".invoice");
    showInvoice.value = true;
    let worker = await html2pdf()
        .set(pdfOptions)
        .from(invoiceElement)
        .save("Invoice-" + InvoiceNumber.value);
    showInvoice.value = false;
};

const generatePDF = async () => {
    const pdfOptions = {
        filename: "Invoice-" + InvoiceNumber.value + ".pdf",
        image: { type: "jpeg", quality: 1 },
        html2canvas: { scale: 2 },
        jsPDF: {
            unit: "mm",
            format: "a4",
            orientation: "portrait",
            compress: true, // Enable font subsetting
        },
    };

    const invoiceElement = document.querySelector(".invoice");
    showInvoice.value = true;
    let worker = await html2pdf()
        .set(pdfOptions)
        .from(invoiceElement)
        .toPdf()
        .output("blob")
        .then((data) => {
            showInvoice.value = false;
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
