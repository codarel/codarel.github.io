$(document).ready(function () {
  let jumlah = 0;
  $(".count").each(function (i, v) {
    let newAngka = [Number($(v).val())].reduce(
      (accumulator, currentValue) => accumulator + currentValue,
      0
    );

    jumlah = jumlah + newAngka;
    $(".subtotal").html(jumlah);
    $(".total").html(jumlah + 12000);
  });

  $(".plus").click(function () {
    if ($(this).prev().val() < 100) {
      $(this)
        .prev()
        .val(+$(this).prev().val() + 1);
      let st = 0;
      let i = $(this);
      let up = $(i).data("unit-price");
      let q = $(this).prev().val();
      st = st + up * q;
      const ids = [$(i).data("id")];

      $(".count").each(function (i, v) {
        if (ids.indexOf($(v).data("id")) > -1) {
          $(this).html(st);
          $(this).val(st);
        }
      });

      let jumlah = 0;
      $(".count").each(function (i, v) {
        let newAngka = [Number($(v).text())].reduce(
          (accumulator, currentValue) => accumulator + currentValue,
          0
        );

        jumlah = jumlah + newAngka;
        console.log(jumlah);
        $(".subtotal").html(jumlah);
      });
    }
  });

  $(".minus").click(function () {
    if ($(this).next().val() > 1) {
      if ($(this).next().val() > 1)
        $(this)
          .next()
          .val(+$(this).next().val() - 1);
      let st = 0;
      let i = $(this);
      let up = $(i).data("unit-price");
      let q = $(this).next().val();
      st = st + up * q;
      const ids = [$(i).data("id")];

      $(".count").each(function (i, v) {
        if (ids.indexOf($(v).data("id")) > -1) {
          $(this).html(st);
          $(this).val(st);
        }
      });

      let jumlah = 0;
      $(".count").each(function (i, v) {
        const newAngka = [Number($(v).text())].reduce(
          (accumulator, currentValue) => accumulator + currentValue,
          0
        );
        jumlah = jumlah + newAngka;
        console.log(jumlah);
        $(".subtotal").html(jumlah);
      });
    }
  });

  $(function () {
    $(".product-des").each(function (i) {
      len = $(this).text().length;
      if (len > 15) {
        $(this).text($(this).text().substr(0, 15) + "...");
      }
    });
  });
});
