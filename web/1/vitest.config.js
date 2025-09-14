import { defineConfig } from 'vitest/config';

export default defineConfig({
  test: {
    environment: 'jsdom',
    coverage: {
      provider: 'v8',
      reportsDirectory: './test/coverege',
      reporter: ['text', 'html'],
      all: true,
      include: ['scripts/**/*.js'],
      exclude: [
        'tests/**',
        '**/*.test.js',
        '**/node_modules/**'
      ],
    }
  }
});