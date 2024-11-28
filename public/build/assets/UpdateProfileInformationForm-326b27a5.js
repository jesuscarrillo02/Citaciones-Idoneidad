import{Q as v,T as x,o as l,f as n,b as s,a as r,u as t,d as m,w as u,i as k,A as V,g as c,z as _,e as b,j as h}from"./app-04b634f9.js";import{a as p,b as g,_ as y}from"./TextInput-7f975af2.js";import{P as w}from"./PrimaryButton-b0effbd1.js";import"./_plugin-vue_export-helper-c27b6911.js";const S={key:0},B={class:"text-sm mt-2 text-gray-800 dark:text-gray-200"},N={class:"mt-2 font-medium text-sm text-green-600 dark:text-green-400"},E={class:"flex items-center gap-4"},P={key:0,class:"text-sm text-gray-600 dark:text-gray-400"},q={__name:"UpdateProfileInformationForm",props:{mustVerifyEmail:{type:Boolean},status:{type:String}},setup(d){const i=v().props.auth.user,a=x({name:i.name,email:i.email});return(f,e)=>(l(),n("section",null,[e[6]||(e[6]=s("header",null,[s("h2",{class:"text-lg font-medium text-gray-900 dark:text-gray-100"},"Profile Information"),s("p",{class:"mt-1 text-sm text-gray-600 dark:text-gray-400"}," Update your account's profile information and email address. ")],-1)),s("form",{onSubmit:e[2]||(e[2]=b(o=>t(a).patch(f.route("profile.update")),["prevent"])),class:"mt-6 space-y-6"},[s("div",null,[r(y,{for:"name",value:"Name"}),r(p,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:t(a).name,"onUpdate:modelValue":e[0]||(e[0]=o=>t(a).name=o),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),r(g,{class:"mt-2",message:t(a).errors.name},null,8,["message"])]),s("div",null,[r(y,{for:"email",value:"Email"}),r(p,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:t(a).email,"onUpdate:modelValue":e[1]||(e[1]=o=>t(a).email=o),required:"",autocomplete:"username"},null,8,["modelValue"]),r(g,{class:"mt-2",message:t(a).errors.email},null,8,["message"])]),d.mustVerifyEmail&&t(i).email_verified_at===null?(l(),n("div",S,[s("p",B,[e[4]||(e[4]=m(" Your email address is unverified. ")),r(t(h),{href:f.route("verification.send"),method:"post",as:"button",class:"underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},{default:u(()=>e[3]||(e[3]=[m(" Click here to re-send the verification email. ")])),_:1},8,["href"])]),k(s("div",N," A new verification link has been sent to your email address. ",512),[[V,d.status==="verification-link-sent"]])])):c("",!0),s("div",E,[r(w,{disabled:t(a).processing},{default:u(()=>e[5]||(e[5]=[m("Save")])),_:1},8,["disabled"]),r(_,{"enter-active-class":"transition ease-in-out","enter-from-class":"opacity-0","leave-active-class":"transition ease-in-out","leave-to-class":"opacity-0"},{default:u(()=>[t(a).recentlySuccessful?(l(),n("p",P,"Saved.")):c("",!0)]),_:1})])],32)]))}};export{q as default};
