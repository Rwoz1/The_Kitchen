// إضافة مستمع حدث عند إرسال النموذج
document.getElementById('register-form').addEventListener('submit', function(event) {
    // منع الإرسال الافتراضي للنموذج لتجنب إعادة تحميل الصفحة
    event.preventDefault();

    // الحصول على حقل البريد الإلكتروني
    var emailField = document.querySelector('input[name="email"]');
    // استخراج قيمة البريد الإلكتروني المدخل
    var email = emailField.value;
    // تعريف نمط البريد الإلكتروني الصحيح باستخدام التعبيرات العادية
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // الحصول على حقل رقم الهاتف
    var phoneField = document.querySelector('input[name="phone"]');
    // استخراج قيمة رقم الهاتف المدخل
    var phone = phoneField.value;
    // تعريف نمط رقم الهاتف الصحيح (10 أرقام) باستخدام التعبيرات العادية
    var phonePattern = /^\d{10}$/;

    // التحقق من مطابقة البريد الإلكتروني للنمط المحدد
    if (!emailPattern.test(email)) {
        // إذا كان البريد الإلكتروني غير صحيح، عرض رسالة تنبيه للمستخدم
        alert("البريد الإلكتروني غير صحيح");
        // إيقاف عملية إرسال النموذج
        return;
    }

    // التحقق من مطابقة رقم الهاتف للنمط المحدد
    if (!phonePattern.test(phone)) {
        // إذا كان رقم الهاتف غير صحيح، عرض رسالة تنبيه للمستخدم
        alert("رقم الهاتف يجب أن يتكون من 10 أرقام");
        // إيقاف عملية إرسال النموذج
        return;
    }

    // إذا كانت جميع التحققّات صحيحة، إرسال النموذج بشكل طبيعي
    this.submit();
});
