<template>
    <BContainer class="px-5 my-1">
        <BRow
            ><BCol><h3>CREATE NEW INVOICE</h3></BCol></BRow
        >
        <BRow class="my-2">
            <BCol cols="4">
                <BFormGroup>
                    <BFormInput
                        size="md"
                        v-model="InvoiceDate"
                        type="date"
                    ></BFormInput></BFormGroup
            ></BCol>

            <BCol cols="4">
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
          
            <BCol cols="4">
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
        <BRow>  <BCol cols="4">
                <BFormGroup>
                    <BInputGroup size="md" prepend="CGST %">
                        <BFormInput
                        min="0"
                        max="100"
                                            v-model="cgst"
                                            type="number"
                                            placeholder="CGST"
                                        ></BFormInput>
    
                    </BInputGroup>
                </BFormGroup></BCol
            ><BCol cols="4">
                <BFormGroup>
                    <BInputGroup size="md" prepend="SGST %">
                        <BFormInput
                        min="0"
                        max="100"
                                            v-model="sgst"
                                            type="number"
                                            placeholder="SGST"
                                        ></BFormInput>
                    </BInputGroup>
                </BFormGroup></BCol
            >
            <BCol cols="4">
                <BFormGroup>
                    <BInputGroup size="md" prepend="IGST %">
                        <BFormInput
                        min="0"
                        max="100"
                                            v-model="igst"
                                            type="number"
                                            placeholder="IGST"
                                        ></BFormInput>
                    </BInputGroup>
                </BFormGroup></BCol
            ></BRow>
        <BRow class="my-2">
            <BCol cols="12">
                <BCardGroup deck>
                    <BCard>
                        <BModal
                                    v-model="customersmodal"
                                    title="Choose Customer"
                                    size="lg"
                                    hide-header
                                    hide-footer
                            
                                >
                                <BRow  class="mb-2">
                            <BCol cols="4" class="ms-auto">
                                <BFormGroup>
                    <BInputGroup size="md" >
                        <BFormInput
                            v-model="customersStore.search"
                            type="search"
                           v-on:Input="getCustomers"
                        ></BFormInput>
                   </BInputGroup>
                </BFormGroup>

                            </BCol>
                        </BRow>
                            <BTable  hover
                            small
                            class="text-center"
                            bordered
                            :items="customersStore.customers"
                            :fields="customersStore.fields"
                            responsive>
                            <template #cell(actions)="data">
                            <b-button
                                v-if="checkPermission('customers', 'View')"
                                size="sm"
                                class="rounded-circle me-2"
                               v-on:click="selectCustomer(data.item.id)"
                                variant="outline-success"
                            >
                                <FontAwesomeIcon icon="check" />
                            </b-button>
                        </template>
                        </BTable>
        <b-row align-h="end" class="mt-2">
         <b-col xl="1" lg="2" md="2" class="p-2">
           <b-form-select
             v-if="customersStore.rows > 5"
             v-model="customersStore.search"
             :options="customersStore.options"
             size="md"
             v-on:change="customersStore.perPage"
             varient="dark"
           ></b-form-select>
         </b-col>
         <b-col xl="5" lg="6" md="8" class="p-2">
           <b-pagination
             v-if="customersStore.rows / customersStore.perPage > 1"
             v-on:click="getCustomers"
             v-model="customersStore.currentPage"
             :total-rows="customersStore.rows"
             :per-page="customersStore.perPage"
           ></b-pagination>
         </b-col>
       </b-row>
                            </BModal>
                        <template #header> Customer Details  - 
                             <span
             size="sm"
               @click="customersmodal = !customersmodal"
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
                                            rows="2"
                                        ></BFormTextarea> </BInputGroup
                                ></BFormGroup>
                                <BFormGroup class="mb-2">
                                    <BInputGroup size="md" prepend="GST #">
                                        <BFormInput
                                            v-model="customer.gst_number"
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
                                    <BTh width="40%">Product</BTh>
                                    <BTh>Select Product</BTh>
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
                                            v-model="product.name"
                                            placeholder="Enter name"
                                            rows="1"
                                        ></BFormTextarea>
                                        
                                    </BTd>
                                    <BTd> 
                                        <BModal
                                    v-model="productsmodal"
                                    title="Choose Customer"
                                    size="lg"
                                    hide-header
                                    hide-footer
                            
                                >
                                <BRow v-if="errors.error" class="text-danger text-center">{{ errors.error }}</BRow>
                                <BRow  class="mb-2">
                               
                            <BCol cols="4" class="ms-auto">
                                <BFormGroup>
                    <BInputGroup size="md" >
                        <BFormInput
                            v-model="productsStore.search"
                            type="search"
                           v-on:Input="getProducts"
                        ></BFormInput>
                   </BInputGroup>
                </BFormGroup>

                            </BCol>
                        </BRow>
                            <BTable  hover
                            small
                            class="text-center"
                            bordered
                            :items="productsStore.products"
                            :fields="productsStore.fields"
                            responsive>
                            <template #cell(actions)="data">
                              
                            <b-button
                                v-if="checkPermission('products', 'View')"
                                size="sm"
                                class="rounded-circle me-2"
                               v-on:click="selectProduct(data.item.id)"
                                variant="outline-success"
                            >
                                <FontAwesomeIcon icon="check" />
                            </b-button>
                        </template>
                        </BTable>
        <b-row align-h="end" class="mt-2">
         <b-col xl="1" lg="2" md="2" class="p-2">
           <b-form-select
             v-if="productsStore.rows > 5"
             v-model="productsStore.currentPage"
             :options="productsStore.options"
             size="md"
             v-on:change="productsStore.perPage"
             varient="dark"
           ></b-form-select>
         </b-col>
         <b-col xl="5" lg="6" md="8" class="p-2">
           <b-pagination
             v-if="productsStore.rows / productsStore.perPage > 1"
             v-on:click="getProducts"
             v-model="productsStore.currentPage"
             :total-rows="productsStore.rows"
             :per-page="productsStore.perPage"
           ></b-pagination>
         </b-col>
       </b-row>
                            </BModal>
                                        
                                        <span size="sm"
               variant="outline-dark"
               class="text-primary"
               @click="changeProduct(index)"
             >Select </span
             ></BTd>

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
                                            v-model="product.price"
                                            type="number"
                                            placeholder="Enter price"
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
            :cgst="cgst"
            :sgst="sgst"
            :igst="igst"
        />
    </div>
</template>

<script setup>
import { ref, defineAsyncComponent } from "vue";
import html2pdf from "html2pdf.js";
import { useCustomersStore } from "@/stores/customers.js";
import { useProductsStore } from "@/stores/products.js";
import { useLoginStore } from "@/stores/login.js";
const InvoiceDesign = defineAsyncComponent(() => import('./invoiceDesign.vue'));
const { checkPermission } = useLoginStore();
const { getCustomers, setPerPage : setCustomerPerPage} = useCustomersStore();
const { getProducts, setPerPage :setProductsPerPage} = useProductsStore();
const customersStore = useCustomersStore();
const productsStore = useProductsStore();
const productIndex=ref(null);
getCustomers();
getProducts();

const errors=ref([]);
const showInvoice = ref(false);
const customersmodal=ref(false);
const productsmodal=ref(false);
const InvoiceDate = ref(getCurrentDate());
const InvoiceNumber = ref("ICS202301001");
const DeliveryType = ref("office");
const cgst = ref(6);
const sgst = ref(6);
const igst = ref(0);
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
    name:null,
    company_name:null,
    email:null,
    phone:null,
    address:null,
    gst_number:null,
});

const products = ref([
    {
        name: "",
        hsnCode: null,
        quantity: null,
        price: null,
        uom: "",
    },
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
        name: "",
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
const selectCustomer=(id)=>{
 const selectedCustomer=customersStore.customers.find((customer) => customer.id == id);
  customer.value=selectedCustomer;
  customersmodal.value=!customersmodal.value;
}
const changeProduct=(index)=>{
    productIndex.value=index;
    productsmodal.value=!productsmodal.value;
}
const selectProduct=(id)=>{
const selectedProduct=productsStore.products.find((product) => product.id == id);
const productExists = products.value.find((product )=> product.id === id);
if(!productExists){
  products.value.splice(productIndex.value,1,selectedProduct);
  productsmodal.value=!productsmodal.value;
}else{
    errors.value.error="You have already Selected this Product";

}
}
</script>
