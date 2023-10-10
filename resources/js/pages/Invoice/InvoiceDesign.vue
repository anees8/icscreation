<script setup>
import {computed} from "vue";
import { useGeneralStore } from "@/stores/general.js";

const { formattedAmount } = useGeneralStore();

const props =defineProps({
  customer: {
    type: Object,
    required: true
  },
  products: {
    type: Array,
     required: true
  },
  InvoiceDate:{
    type:String,
    required: true
  },
  InvoiceNumber:{
    type:String,
    required: true
  },
  DeliveryType:{
    type:String,
    required: true
  },
  cgst:{
    type:Number,
    required: true
  },
  sgst:{
    type:Number,
    required: true
  },
  igst:{
    type:Number,
    required: true
  },
  
});
const subtotal = computed(() => {
    let total = 0;
    for (const product of props.products) {
        total += product.quantity * product.rate;
    }
    return total;
});

function formatDate(inputDate) {
    const date = new Date(inputDate);
    const options = { year: "numeric", month: "2-digit", day: "2-digit" };
    const formattedDate = date.toLocaleDateString("en-GB", options); // Adjust the locale as needed
    return formattedDate;
}
</script>
<template>
      <div
               
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
        <div style="display: flex; align-items: start; padding: 2mm 0 0 0">
        <div style="flex: 1; color: #27374d; padding-left: 15mm">
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
        <li   v-if="customer.address">{{customer.address}}</li>
        <li v-if="customer.phone">Phone: {{customer.phone}}</li>
        <li v-if="customer.email">Email: {{customer.email}}</li>
        <li v-if="customer.gst_number"><strong>GST# : {{customer.gst_number}}</strong></li>
        </ul>
        </div>
        <div style="flex: 1; color: #27374d; padding:5mm">
        <ul
        style="
        list-style-type: none;
        font-weight: bold;
        margin: 0;
        padding-top:10px;
        line-height: 2rem;
        "
        >
        <li><strong>Invoice Number: {{InvoiceNumber}}</strong></li>
        <li><strong>Invoice Date: {{ formatDate(InvoiceDate) }}</strong></li>
        <li><strong>Transport: {{DeliveryType}}</strong></li>
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
                        <tr  v-if="cgst!=0" style="line-height: 2rem; color: #27374d">
                            <td
                                colspan="6"
                                style="
                                    text-align: right;
                                    font-weight: bold;
                                    padding: 5px;
                                "
                            >
                                CGST ({{cgst}}%)
                            </td>
                            <td style="padding: 5px">
                                {{ formattedAmount((subtotal * cgst) / 100) }}
                            </td>
                        </tr>
                        <tr v-if="sgst!=0" style="line-height: 2rem; color: #27374d">
                            <td
                            
                                colspan="6"
                                style="
                                    text-align: right;
                                    font-weight: bold;
                                    padding: 5px;
                                "
                            >
                                SGST ({{(sgst)}}%)
                            </td>
                            <td style="padding: 5px">
                                {{ formattedAmount((subtotal * sgst) / 100) }}
                            </td>
                        </tr>
                        <tr v-if="igst!=0" style="line-height: 2rem; color: #27374d">
                            <td
                            
                                colspan="6"
                                style="
                                    text-align: right;
                                    font-weight: bold;
                                    padding: 5px;
                                "
                            >
                                IGST ({{(igst)}}%)
                            </td>
                            <td style="padding: 5px">
                                {{ formattedAmount((subtotal * igst) / 100) }}
                            </td>
                        </tr>
                        <tr v-if="cgst!=0||sgst!=0||igst!=0" style="line-height: 2rem; color: #27374d">
                            <td
                            
                                colspan="6"
                                style="
                                    text-align: right;
                                    font-weight: bold;
                                    padding: 5px;
                                "
                            >
                                GST Total
                            </td>
                            <td style="padding: 5px">
                                {{ formattedAmount((subtotal * (cgst+sgst+igst)) / 100) }}
                            </td>
                        </tr>
                        <tr  v-if="(Math.round(
                                   (subtotal+((subtotal * (cgst+sgst+igst))/100))) - (subtotal+((subtotal * (cgst+sgst+igst))/100))).toFixed(2)!=0" style="line-height: 2rem; color: #27374d">
                            <td
                           
                                colspan="6"
                                style="
                                    text-align: right;
                                    font-weight: bold;
                                    padding: 5px;
                                "
                            >
                               Round
                            </td>
                            <td style="padding: 5px">
                                {{
                              formattedAmount(  
                               (Math.round(
                                   (subtotal+((subtotal * (cgst+sgst+igst))/100))) - (subtotal+((subtotal * (cgst+sgst+igst))/100))).toFixed(2))
                                }}
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
                                    formattedAmount(Math.round(
                                   (subtotal+((subtotal * (cgst+sgst+igst))/100)))
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
                    padding: 10mm 10mm 0 10mm;
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
                <div class="seal-half" style="flex: 1;text-align: end">
                    <h6><strong>For ICS CREATIONS</strong></h6>
                    <div style="height: 30px"></div>
                    <h6><strong>Authorized Signatory</strong></h6>
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
tfoot tr:nth-child(4) {
    background-color: #eff0f1;
}
tfoot tr:nth-child(5) {
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
