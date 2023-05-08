<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head,useForm } from '@inertiajs/vue3';

</script>

<script>
    try{
    theViewer.defaultViewer = new theViewer.Viewer({});
    }catch(e){}
</script>

<template>
    <Head title="View Travel" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Travel</h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="sidebar">
            <div id="outline"></div>
        </div>
        <div id="page-container">
            <div id="pf1" class="pf w0 h0" data-page-no="1">
                <div class="pc pc1 w0 h0">
                <img class="bi x0 y0 w1 h1" alt="" src="bg1.png"/>
                <div class="c x1 y1 w2 h2">
                    <div class="t m0 x2 h3 y2 ff1 fs0 fc0 sc0 ls0 ws0">Republic of the Philippines</div>
                </div>
                <div class="c x3 y3 w3 h4">
                    <div class="t m0 x4 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">Doc. Ref. No.:</div>
                </div>
                <div class="c x5 y3 w4 h4">
                    <div class="t m0 x6 h5 y4 ff3 fs1 fc0 sc0 ls0 ws0">CA- TO -2023-04-806</div>
                </div>
                <div class="c x3 y1 w3 h4">
                    <div class="t m0 x4 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">Effectivity Date:</div>
                </div>
                <div class="c x5 y1 w4 h4">
                    <div class="t m0 x7 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">4/26/2023</div>
                </div>
                <div class="c x1 y5 w2 h4">
                    <div class="t m0 x8 h6 y6 ff3 fs2 fc0 sc0 ls0 ws0">KALINGA STATE UNIVERSITY</div>
                </div>
                <div class="c x3 y5 w3 h4">
                    <div class="t m0 x4 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">Revision No.:</div>
                </div>
                <div class="c x5 y5 w4 h4">
                    <div class="t m0 x9 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">0</div>
                </div>
                <div class="c x1 y7 w2 h4">
                    <div class="t m0 xa h3 y8 ff1 fs0 fc0 sc0 ls0 ws0">Bulanao, Tabuk City, Kalinga</div>
                </div>
                <div class="c x3 y7 w3 h4">
                    <div class="t m0 x4 h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">Series No.</div>
                </div>
                <div class="c x5 y7 w4 h4">
                    <div class="t m0 xb h5 y4 ff2 fs1 fc0 sc0 ls0 ws0">755</div>
                </div>
                <div class="c x1 y9 w5 h2">
                    <div class="t m0 xc h7 ya ff3 fs3 fc0 sc0 ls0 ws0">AUTHORITY TO TRAVEL</div>
                </div>
                <div class="c x1 yb w6 h4">
                    <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Name of Official/Employees</div>
                </div>
                <div class="c x3 yb w7 h4">
                    <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Position</div>
                </div>
                <div class="c x1 yd w6 h4">
                    <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">JENNIFER BACTAD</div>
                </div>
                <div class="c x1 ye w6 h8">
                    <div class="t m0 x4 h3 yf ff3 fs0 fc0 sc0 ls0 ws0">VENUS F. BALILING</div>
                </div>
                <div class="c x3 y10 w7 h4">
                    <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Time of Travel</div>
                </div>
                <div class="c xd y11 w8 h4">
                    <div class="t m0 x4 h9 y12 ff4 fs1 fc1 sc0 ls0 ws0"> </div>
                </div>
                <div class="c xe y13 w9 h4">
                    <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Destination: </div>
                </div>
                <div class="c x3 y13 w7 h4">
                    <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Inclusive Date of Travel</div>
                </div>
                <div class="c x1 y14 w6 ha">
                    <div class="t m0 xf h3 y15 ff2 fs0 fc0 sc0 ls0 ws0">KSU-Bulanao Kalinga</div>
                </div>
                <div class="c xe y14 w9 ha">
                    <div class="t m0 x10 hb y16 ff2 fs4 fc0 sc0 ls0 ws0">LA TRINIDAD, BENGUET</div>
                </div>
                <div class="c x3 y17 w7 h4">
                    <div class="t m0 x11 hb y18 ff2 fs4 fc0 sc0 ls0 ws0">MAY 3-5, 2023</div>
                </div>
                <div class="c x1 y19 w6 h4">
                    <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Purpose of Travel:</div>
                </div>
                <div class="c x3 y19 w7 h4">
                    <div class="t m0 x4 h3 yc ff3 fs0 fc0 sc0 ls0 ws0">Nature of Travel </div>
                </div>
                <div class="c x1 y1a w2 hc">
                    <div class="t m0 x4 hb y1b ff2 fs4 fc0 sc0 ls0 ws0">To attend the PAFTE-CAR Students Congress on May 4, 2023 at BSU</div>
                    <div class="t m0 x4 hb y1c ff2 fs4 fc0 sc0 ls0 ws0">Gymnasium Benguet.</div>
                </div>
                <div class="c x3 y1d w7 h4">
                    <div class="t m0 x4 h3 yc ff2 fs0 fc0 sc0 ls0 ws0">(x) Official Business</div>
                </div>
                <div class="c x3 y1e w7 h4">
                    <div class="t m0 x4 h3 yf ff2 fs0 fc0 sc0 ls0 ws0">() Official Time</div>
                </div>
                <div class="c xe y1f w9 h4">
                    <div class="t m0 x7 hd y20 ff5 fs1 fc0 sc0 ls0 ws0">RECOMMENDING APPROVAL:</div>
                </div>
                <div class="c x3 y1f w7 h4">
                    <div class="t m0 x12 hd y20 ff5 fs1 fc0 sc0 ls0 ws0">APPROVED BY:</div>
                </div>
                <div class="c xe y21 w9 h4">
                    <div class="t m0 x4 h9 y12 ff6 fs1 fc2 sc0 ls0 ws0">ṅṅ</div>
                </div>
                <div class="c xe y22 w9 h4">
                    <div class="t m0 x13 hd y20 ff5 fs1 fc3 sc0 ls0 ws0">BRENDA B. LUMINES</div>
                </div>
                <div class="c x3 y22 w7 h4">
                    <div class="t m0 x14 hd y20 ff5 fs1 fc0 sc0 ls0 ws0">GIARHARD C. AWIS, MIT</div>
                </div>
                <div class="c xe y23 w9 h4">
                    <div class="t m0 x15 he y24 ff2 fs5 fc4 sc0 ls0 ws0">DEAN, COED</div>
                </div>
                <div class="c x3 y23 w7 h4">
                    <div class="t m0 x16 he y24 ff1 fs5 fc0 sc0 ls0 ws0">BULANAO CAMPUS ADMINISTRATOR</div>
                </div>
                <div class="c x1 y25 w6 hf">
                    <div class="t m0 x4 h5 y20 ff2 fs1 fc1 sc0 ls0 ws0">.</div>
                </div>
                <div class="c xe y26 w9 hf">
                    <div class="t m0 x4 h5 y27 ff2 fs1 fc1 sc0 ls0 ws0">          </div>
                </div>
                <div class="c x1 y28 w6 hf">
                    <div class="t m0 x17 h5 y27 ff3 fs1 fc1 sc0 ls0 ws0"> </div>
                </div>
                </div>
                <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
            </div>
        </div>
        <div class="loading-indicator">
        </div>
        </div>
        <div class="py-12">
            
        </div>
    </AuthenticatedLayout>
</template>