<?php
namespace App\Repository\Service\multi_services;
use App\Interfaces\Service\multi_services\Multi_serviceInterface;
use App\Models\Service\MultiService;
use App\Models\Service\SingleService;
use Illuminate\Support\Str;

class Multi_serviceRepository implements Multi_serviceInterface
{
    public function index()
    {
        $multiservices = MultiService::all();
        $singleServices = SingleService::all();
        return view('Dashboard.Services.MultiService.index', compact('multiservices', 'singleServices'));
    }

    public function store($request)
    {
        $serviceIds = $request->input('service_id');
        $quantities = $request->input('quantity_');

        // مصفوفة لحفظ المجاميع الفرعية
        $subtotals = [];
        $multiservice = new MultiService();
        $multiservice->name = $request->name;
        $multiservice->notes = $request->notes;
        $multiservice->discount_value = $request->discount_value;

        // معالجة كل خدمة
        foreach ($serviceIds as $index => $serviceId) {
            // الحصول على تفاصيل الخدمة من قاعدة البيانات
            $single = SingleService::findOrFail($serviceId);

            // الحصول على الكمية المرتبطة بهذه الخدمة
            $quantity = $quantities[$index];

            // التأكد من أن الكمية أكبر من 0
            if ($quantity > 0) {
                // حساب المجموع الفرعي: سعر الخدمة * الكمية
                $subtotal = $single->price * $quantity;

                // تخزين المجموع الفرعي في المصفوفة
                $subtotals[] = $subtotal;
            }
        }

        // حساب الإجمالي قبل الخصم بجمع المجاميع الفرعية
        $totalBeforeDiscount = array_sum($subtotals);
        $multiservice->total_before_discount = $totalBeforeDiscount;

        // حساب الخصم والإجمالي بعد الخصم
        $discount = $request->discount_value;
        $totalAfterDiscount = $totalBeforeDiscount - $discount;
        $multiservice->total_after_discount = $totalAfterDiscount;

        // حساب الضريبة
        $taxRate = $request->tax_rate;
        $totalTax = ($totalAfterDiscount * $taxRate) / 100;
        $multiservice->tax_rate = $taxRate;

        // حساب الإجمالي مع الضريبة
        $totalWithTax = $totalAfterDiscount + $totalTax;
        $multiservice->total_with_tax = $totalWithTax;

        // حفظ الـ multiservice قبل الربط مع الخدمات
        $multiservice->save();

        // ربط الخدمات باستخدام الجدول الوسيط
        foreach ($serviceIds as $index => $serviceId) {
            $multiservice->service_group()->attach($serviceId, ['quantity' => $quantities[$index]]);
        }

        // حفظ العملية أو تنفيذ أي عمليات أخرى هنا
        session()->flash('add');
        return redirect()->back();

    }



    public function update($request, $id)
    {
        // جلب قيم الخدمة والكمية من النموذج
        $serviceIds = $request->input('service_id');
        $quantities = $request->input('quantity_');

        // مصفوفة لحفظ المجاميع الفرعية
        $subtotals = [];
        $multiservice = MultiService::findOrFail($id);
        $multiservice->name = $request->name;
        $multiservice->notes = $request->notes;
        $multiservice->discount_value = $request->discount_value;

        // معالجة كل خدمة لحساب الإجمالي
        foreach ($serviceIds as $index => $serviceId) {
            $single = SingleService::findOrFail($serviceId);  // جلب الخدمة
            $quantity = $quantities[$index];                  // جلب الكمية

            if ($quantity > 0) {
                $subtotal = $single->price * $quantity;      // حساب المجموع الفرعي
                $subtotals[] = $subtotal;                    // إضافة المجموع الفرعي إلى المصفوفة
            }
        }

        // حساب الإجمالي قبل الخصم
        $totalBeforeDiscount = array_sum($subtotals);
        $multiservice->total_before_discount = $totalBeforeDiscount;

        // حساب الإجمالي بعد الخصم
        $discount = $request->discount_value;
        $totalAfterDiscount = $totalBeforeDiscount - $discount;
        $multiservice->total_after_discount = $totalAfterDiscount;

        // حساب الضريبة
        $taxRate = $request->tax_rate;
        $totalTax = ($totalAfterDiscount * $taxRate) / 100;
        $multiservice->tax_rate = $taxRate;

        // حساب الإجمالي مع الضريبة
        $totalWithTax = $totalAfterDiscount + $totalTax;
        $multiservice->total_with_tax = $totalWithTax;

        // حفظ الـ multiservice قبل الربط مع الخدمات
        $multiservice->save();

        // تجهيز البيانات لربط الخدمات بالجدول الوسيط
        $data = [];
        foreach ($serviceIds as $index => $serviceId) {
            $data[$serviceId] = ['quantity' => $quantities[$index]];  // إضافة معرف الخدمة والكمية للمصفوفة
        }

        // استخدام sync لربط الخدمات مع الكمية بالجدول الوسيط
        $multiservice->service_group()->sync($data);

        // حفظ العملية أو تنفيذ أي عمليات أخرى هنا
        session()->flash('edit' );
        return redirect()->route('multi-services.index');
    }


    public function edit($id)
    {
        $multiservice = MultiService::findOrFail($id);
        $singleServices=SingleService::all();
        return view('Dashboard.Services.MultiService.update',compact('multiservice','singleServices'));

    }

    public function destroy($request)
    {
        $multiService=MultiService::findOrFail($request->id);
        $multiService->delete();
        session()->flash('delete');
        return redirect()->back();
    }
}
