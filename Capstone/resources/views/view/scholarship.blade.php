<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
</head>

<body>
    <header>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <nav class="bg-gray-100">
            <div class="max-w-7xl mx-auto px-2 py-4 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                        <button type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                            aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <!--
              Icon when menu is closed.

              Heroicon name: outline/menu

              Menu open: "hidden", Menu closed: "block"
            -->
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <!--
              Icon when menu is open.

              Heroicon name: outline/x

              Menu open: "block", Menu closed: "hidden"
            -->
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex-shrink-0 flex items-center">
                            <img class="block lg:hidden h-14 w-auto" src="images/sLogo.png" alt="Workflow">
                            <img class="hidden lg:block h-14 w-auto" src="images/sLogo.png" alt="Workflow">
                        </div>
                    </div>
                    <div class="items-right justify-right sm:items-stretch sm:justify-end">
                        <div class="hidden sm:block sm:ml-6">
                            <div class="flex space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="{{ route('landing-page') }}" class="text-black px-3 py-2 rounded-md text-sm font-medium"
                                    aria-current="page"><b>Home</b></a>

                                <a href="{{ route('scholarship.view') }}"
                                    class="bg-gray-900 text-white hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">View
                                    Scholarships</a>

                                <a href="https://www.ustp.edu.ph/cdeo/admission-and-scholarship-office/"
                                    class="text-black hover:bg-blue-900 hover:text-white px-3 py-2 rounded-md text-sm font-medium">About
                                    Us</a>

                                <a href="{{ route('filament.auth.login') }}">
                                    <button
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Sign
                                        in</button>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="sm:hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                    <a href="{{ route('landing-page') }}"
                        class="bg-gray-900 text-white hover:bg-blue-900 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                        aria-current="page">Home</a>

                    <a href="#"
                        class="text-black-300 hover:bg-blue-900 hover:text-white block px-3 py-2 rounded-md text-base font-medium">View
                        Scholarships</a>

                    <a href="#"
                        class="text-black-300 hover:bg-blue-900 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About
                        Us</a>

                    <a href="{{ route('filament.auth.login') }}">
                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Sign
                            in</button>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <div class="pt-16 pb-5 bg-gray-50 overflow-hidden">
        <div class="container m-auto px-6 space-y-8 text-gray-500 md:px-12">
            <div>
                <span class="text-gray-600 text-lg font-semibold">USTP Scholarships</span>
                <h2 class="mt-4 text-2xl text-gray-900 font-bold md:text-4xl">View available scholarships <br
                        class="lg:block" hidden> partnered with our office!</h2>
            </div>
            <div
                class="mt-16 grid border divide-x divide-y rounded-xl overflow-hidden sm:grid-cols-2 lg:divide-y-0 lg:grid-cols-3 xl:grid-cols-4">
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/ched_logo.png" class="w-10" width="512" height="512" alt="ched_logo">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">CHED
                                Scholarship: Private Education Student Financial Assistance (PESFA)</h5>
                            <p class="text-sm text-gray-600">This program is one form of assistance to students in
                                private
                                education under RA 8645, otherwise known as “Expanded Government Assistance to
                                Students and Teachers in Private Education Act”.
                            </p>
                        </div>
                        <a href="https://chedscholarships.com/"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/cso_logo.png" class="w-10" width="512" height="512" alt="cso_logo">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">Iskolar
                                sa Dakbayan (ISDA)</h5>
                            <p class="text-sm text-gray-600">The City Scholarships Office is a division of City Social
                                Welfare and
                                Development created to alleviate the lives of every Kagay-anon. The scholarship covers
                                a comprehensive and inclusive opportunity for deserving and qualified students
                                regardless of culture, status, race or political color and gives priority to those who
                                are in
                                the margins.</p>
                        </div>
                        <a href="http://cityscholar.cagayandeoro.gov.ph:8080/"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/DOST-SEI.png" class="w-10" width="512" height="512"
                            alt="DOST-SEI_logo">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">
                                DOST-SEI</h5>
                            <p class="text-sm text-gray-600">The DOST-SEI Merit Scholarship Program, formerly known as
                                the NSDB or NSTA Scholarship
                                under RA No. 2067, is awarded to students with high aptitude in science and mathematics
                                and
                                are willing to pursue careers in the fields of science and technology.</p>
                        </div>
                        <a href="https://www.sei.dost.gov.ph/index.php/programs-and-projects/scholarships/undergraduate-scholarships#s-t-undergraduate-scholarships"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl lg:hidden xl:block">
                    <div
                        class="relative p-8 space-y-8 border-dashed rounded-lg transition duration-300 group-hover:bg-white group-hover:border group-hover:translate-x-0">
                        <img src="images/ched_logo.png" class="w-10" width="512" height="512"
                            alt="burger illustration">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">CHED
                                GRANT-IN-AIDS</h5>
                            <p class="text-sm text-gray-600">The Commission on Higher Education (CHED) is offering the
                                Grants-in-Aid Program
                                (Tulong Dunong Scholarship) to support college students with financial aid needed to
                                pursue their academic dreams.</p>
                        </div>
                        <a href="https://chedscholarships.com/"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-1 bg-gray-50 overflow-hidden">
        <div class="container m-auto px-6 space-y-8 text-gray-500 md:px-12">
            <div
                class="mt-16 grid border divide-x divide-y rounded-xl overflow-hidden sm:grid-cols-2 lg:divide-y-0 lg:grid-cols-3 xl:grid-cols-4">
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/cepalco-logo.jpg" class="w-10" width="512" height="512"
                            alt="cepalco-logo">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">
                                CEPALCO Educational Assistance Program</h5>
                            <p class="text-sm text-gray-600">This program is one form of assistance to students in
                                private
                                education under RA 8645, otherwise known as “Expanded Government Assistance to
                                Students and Teachers in Private Education Act”.
                            </p>
                        </div>
                        <a href="https://www.facebook.com/USTPAdScho/posts/call-for-cepalco-scholarship-applicants/2466642536902259/"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/DBP_logo.png" class="w-10" width="512" height="512" alt="DBP_logo">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">DBP -
                                Resources Inclusive Sustainable Education (RISE)</h5>
                            <p class="text-sm text-gray-600">The DBP RISE, the second tranche of DBP Endowment for
                                Education Program (DEEP),
                                is another DBP flagship CSR program for Education. Qualified and deserving high school
                                graduates are given scholarships in DBP RISE-accredited schools to provide educational
                                opportunities to the best and brightest but marginalized high school graduates while
                                strengthening institutional relationship with Program partners.</p>
                        </div>
                        <a href="https://www.dbp.ph/corporate-social-responsibility-programs/dbp-endowment-for-education-program-deep/"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/SM_foundation_logo.png" class="w-10" width="512" height="512"
                            alt="SM_foundation_logo">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">SM
                                Foundation, Inc.</h5>
                            <p class="text-sm text-gray-600">SFI is the heart art of the SM group of companies focused
                                on social inclusion by
                                nurturing and caring for underserved communities where SM is present.
                                Their scholarship is rooted in the belief that when one family member graduates from
                                college, the scholar can help another sibling go to school and serve as the key to lift
                                their family out of poverty.</p>
                        </div>
                        <a href="https://www.sm-foundation.org/what_we_do/college-scholarship-program"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl lg:hidden xl:block">
                    <div
                        class="relative p-8 space-y-8 border-dashed rounded-lg transition duration-300 group-hover:bg-white group-hover:border group-hover:translate-x-0">
                        <img src="images/Home_credit_logo.png" class="w-10" width="512" height="512"
                            alt="burger illustration">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">Home
                                Credit Philippines</h5>
                            <p class="text-sm text-gray-600">A Scholarship grant aim to provide allowance and free
                                laptop to graduating students...
                                (more description please)
                            </p>
                        </div>
                        <a href="https://drive.google.com/file/d/1SaHVbQmsGelgF6p-jzY7cIzsWYW6XaGj/view?usp=sharing"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-1 bg-gray-50 overflow-hidden">
        <div class="container m-auto px-6 space-y-8 text-gray-500 md:px-12">
            <div
                class="mt-16 grid border divide-x divide-y rounded-xl overflow-hidden sm:grid-cols-2 lg:divide-y-0 lg:grid-cols-3 xl:grid-cols-4">
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/YOKOHOMA_logo.png" class="w-10" width="512" height="512"
                            alt="YOKOHOMA_logo">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">
                                Yokohama Tire Phils. Inc.</h5>
                            <p class="text-sm text-gray-600">No available description.
                            </p>
                        </div>
                        <a href="#" class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Link not available</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/PLDT-SMART_logo.png" class="w-10" width="512" height="512"
                            alt="burger illustration">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">
                                PLDT-SMART Foundation</h5>
                            <p class="text-sm text-gray-600">PSF is a program that promotes the provision of support to
                                aspiring teachers in the
                                country through educational programs, grants and partnerships that can help uplift
                                the overall quality of education in the Philippines.</p>
                        </div>
                        <a href="https://www.pldtsmartfoundation.org/work/education"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl lg:hidden xl:block">
                    <div
                        class="relative p-8 space-y-8 border-dashed rounded-lg transition duration-300 group-hover:bg-white group-hover:border group-hover:scale-90">
                        <img src="images/rebisco-logo.png" class="w-10" width="512" height="512"
                            alt="rebiscso-logo">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">
                                Rebisco Foundation Inc.</h5>
                            <p class="text-sm text-gray-600">This scholarship award is designed to address poverty by
                                first targeting the basic
                                social unit—the family. This was conceptualized upon the realization of the
                                company that the communities who gave unwavering support to make them
                                grow belong to the disadvantaged families.
                            </p>
                        </div>
                        <a href="https://www.facebook.com/RFIOfficialPage/"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/Delmonte.jpg" class="w-10" width="512" height="512"
                            alt="burger illustration">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">Del
                                Monte Foundation</h5>
                            <p class="text-sm text-gray-600">Through the Del Monte Foundation, gifted children earn
                                quality education from primary
                                levels up to post-graduate studies through academic, grants-in-aid and sports
                                scholarships. A scholar is supported in each of the communities where DMPI has
                                operations.
                            </p>
                        </div>
                        <a href="https://www.facebook.com/DelMonteFoundation/"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-1 bg-gray-50 overflow-hidden">
        <div class="container m-auto px-6 space-y-8 text-gray-500 md:px-12">
            <div
                class="mt-16 grid border divide-x divide-y rounded-xl overflow-hidden sm:grid-cols-2 lg:divide-y-0 lg:grid-cols-3 xl:grid-cols-4">
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/lifebank.jpg" class="w-10" width="512" height="512"
                            alt="burger illustration">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">
                                Lifebank Foundation</h5>
                            <p class="text-sm text-gray-600">Born as a one realization of the programs to alleviate
                                poverty, Education Scholarship Program
                                (ESP) The ESP is Lifebank's primary program for assisting underprivileged Filipinos in
                                attaining
                                higher education. Through this scholarship program, the SSDD sponsors hundreds of
                                students
                                every year granting many families their first-ever college graduates. Lifebank
                                Foundation
                                believes that education is an essential element in breaking the chain of poverty in the
                                country.</p>
                        </div>
                        <a href="https://www.facebook.com/lifebankfoundation/photos/how-to-be-a-lifebank-scholar-here-are-some-of-the-pre-qualifications1-applicants/378346996306088/"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/ngcp.webp" class="w-10" width="512" height="512"
                            alt="burger illustration">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">
                                National Grid Corporation of the Philippines</h5>
                            <p class="text-sm text-gray-600">The National Grid Corporation of the Philippines (NGCP) is
                                a merit scholarship award
                                aimed to empower the less fortunate and enable a brighter future for the next
                                generation. For NGCP, the provision of this pledges a powerful of the youth towards a
                                brighter future.</p>
                        </div>
                        <a href="https://www.ngcp.ph/advocacies"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl lg:hidden xl:block">
                    <div
                        class="relative p-8 space-y-8 border-dashed rounded-lg transition duration-300 group-hover:bg-white group-hover:border group-hover:translate-x-0">
                        <img src="images/GSIS-Logo.png" class="w-10" width="512" height="512"
                            alt="gsis-logo">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">
                                Government Service Insurance System</h5>
                            <p class="text-sm text-gray-600">GSIS Scholarship Program (GSP), which provides an
                                opportunity for income GSIS
                                members to send their dependents to colleges and universities offering quality
                                education. Since 1998, GSIS has been granting scholarships to deserving children or
                                dependents of members and pensioners as part of the pension fund's corporate social
                                responsibility program.
                            </p>
                        </div>
                        <a href="https://www.gsis.gov.ph/ginhawa-for-all/gsp/"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/National_Commission_on_Indigenous_Peoples_(NCIP).png" class="w-10"
                            width="512" height="512" alt="NCIP_logo">
                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">The
                                National Commission on Indigenous Peoples (NCIP)</h5>
                            <p class="text-sm text-gray-600">The National Commission on Indigenous Peoples is the
                                agency of the national
                                government of the Philippines that is responsible for protecting the rights of the
                                indigenous peoples of the Philippines. It offers an educational program for college
                                study
                                to encourage IP's to have the privilege to obtain adequate education that can uplift
                                their
                                social and economic status. The scholarship is offered to poor but deserving members of
                                the Indigenous Cultural Communities or Indigenous Peoples (ICCs/IPs) within or covered
                                by the jurisdiction of NCIP Regional Office.
                            </p>
                        </div>
                        <a href="https://ncip.gov.ph/programs/"
                            class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Read more</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-1 bg-gray-50 overflow-hidden">
        <div class="container m-auto px-6 space-y-8 text-gray-500 md:px-12">
            <div
                class="mt-16 grid border divide-x divide-y rounded-xl overflow-hidden sm:grid-cols-2 lg:divide-y-0 lg:grid-cols-3 xl:grid-cols-4">
                <div class="relative group bg-white transition hover:z-[1] hover:shadow-2xl">
                    <div class="relative p-8 space-y-8">
                        <img src="images/lifebank.jpg" class="w-10" width="512" height="512"
                            alt="burger illustration">

                        <div class="space-y-2">
                            <h5 class="text-xl text-gray-800 font-medium transition group-hover:text-yellow-600">
                                F.A.S.T. Cooperative</h5>
                            <p class="text-sm text-gray-600">First Analytical Services and Technical Cooperative or its
                                tradename F.A.S.T
                                Laboratories or simply FASTLab established the undergraduate scholarship program as
                                part of its company's social responsibility program that aims to provide full tuition
                                support
                                and allowances for scholars each year who are enrolled specifically in the Bachelor of
                                Science in Chemistry.</p>
                        </div>
                        <a href="#" class="flex justify-between items-center group-hover:text-yellow-600">
                            <span class="text-sm">Link not available</span>
                            <span
                                class="-translate-x-4 opacity-0 text-2xl transition duration-300 group-hover:opacity-100 group-hover:translate-x-0">&RightArrow;</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <footer class="w-full py-16 bg-gray-100">
        <div class="md:px-12 lg:px-28">
            <div class="container m-auto space-y-6 text-gray-600">
                <img src="images/sLogo.png" alt="logo tailus" class="w-40 m-auto" />
                <ul role="list" class="py-4 flex flex-col gap-4 items-center justify-center sm:flex-row sm:gap-8">
                    <li role="listitem"><a href="{{ route('landing-page') }}" class="hover:text-cyan-500">Home</a></li>
                    <li role="listitem"><a href="{{ route('scholarship.view') }}" class="hover:text-cyan-500">View Scholarships</a></li>
                    <li role="listitem"><a href="https://www.ustp.edu.ph/cdeo/admission-and-scholarship-office/"
                            class="hover:text-cyan-500">About Us</a></li>
                    <li role="listitem"><a href="{{ route('filament.auth.login') }}" class="hover:text-cyan-500">Sign in</a></li>
                </ul>
                <div class="w-max m-auto flex items-center justify-between space-x-4">
                    <a href="+639360379533" aria-label="call">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 m-auto"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z">
                            </path>
                        </svg>
                    </a>
                    <a href="scholarship@ustp.edu.ph" aria-label="send mail">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 m-auto"
                            viewBox="0 0 16 16">
                            <path
                                d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z">
                            </path>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/USTPAdScho" title="facebook" target="blank"
                        aria-label="facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 m-auto"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="text-center">
                    <span class="text-sm tracking-wide">Copyright © e-Skolar Portal<span id="year"></span> | All
                        right reserved</span>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
