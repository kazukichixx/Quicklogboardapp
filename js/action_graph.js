const ctx = document.getElementById('actionChart').getContext('2d');

        // アクションデータを整える
        const actionLabels = [1,2,3]
        const actionCounts = [4,5,6]


        // グラフのオプションを設定
        const actionChart = new Chart(ctx, {
            type: 'bar', // または 'pie' で円グラフに変更可能
            data: {
                labels: actionLabels,
                datasets: [{
                    label: 'アクションの回数',
                    data: actionCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });